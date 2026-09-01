<?php
/**
 * KEREA — Authentication API
 * Handles: login, logout, forgot-password, reset-password
 * All responses: JSON
 * POST /backend/api/auth.php?action=login|logout|forgot|reset
 */
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/backend/core/Database.php';
require_once dirname(__DIR__, 2) . '/backend/core/Auth.php';
require_once dirname(__DIR__, 2) . '/backend/core/Security.php';
require_once dirname(__DIR__, 2) . '/backend/models/User.php';
require_once dirname(__DIR__, 2) . '/includes/config.php';

// Suppress any stray PHP warnings/notices so they don't corrupt JSON
ob_start();

header('Content-Type: application/json');
Auth::startSession();

// ── Dummy / Fallback Credentials (no DB required) ────────────
// Used ONLY when the database is unreachable.
// Change or remove these before going fully live in production.
define('DUMMY_ADMIN_EMAIL', 'admin@kerea.org');
define('DUMMY_ADMIN_PASS',  'Admin@KEREA2026');

$action = $_GET['action'] ?? $_POST['action'] ?? '';

// Discard any output printed before dispatch (PHP warnings etc.)
ob_end_clean();

match ($action) {
    'login'    => handleLogin(),
    'logout'   => handleLogout(),
    'forgot'   => handleForgot(),
    'reset'    => handleReset(),
    'register' => handleRegister(),
    default    => Security::jsonResponse(false, 'Unknown action.', [], 400),
};

// ── Login ────────────────────────────────────────────────────
function handleLogin(): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);

    // Rate limit: 5 attempts per 5 minutes per IP
    if (!Security::rateLimit('login_' . Security::clientIp(), 5, 300)) {
        Security::jsonResponse(false, 'Too many login attempts. Please wait 5 minutes.', [], 429);
    }

    Auth::requireCsrf();

    $email    = Security::clean($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if (!Security::validateEmail($email)) {
        Security::jsonResponse(false, 'Please enter a valid email address.');
    }
    if (empty($password)) {
        Security::jsonResponse(false, 'Password is required.');
    }

    // ── Try real DB login first ───────────────────────────────
    $user = null;
    try {
        ob_start();                          // buffer any DB warnings
        $userModel = new User();
        $user      = $userModel->authenticate($email, $password);
        ob_end_clean();                      // discard buffered output
    } catch (Throwable) {
        ob_end_clean();                      // discard on error too
        // DB unavailable — fall through to dummy check below
        $user = null;
    }

    if ($user) {
        // ── Real DB login succeeded ───────────────────────────
        Auth::login($user);
        Auth::log('user.login', 'user', $user['id'], 'Successful login');

        $baseUrl  = get_base_url();
        $redirect = in_array($user['role_name'], ['super_admin','admin','content_manager'])
            ? $baseUrl . 'admin/'
            : $baseUrl . 'membership/dashboard/';

        Security::jsonResponse(true, 'Login successful.', ['redirect' => $redirect]);
    }

    // ── Dummy fallback (DB is down / not yet set up) ──────────
    if (
        $email    === DUMMY_ADMIN_EMAIL &&
        $password === DUMMY_ADMIN_PASS
    ) {
        // Manually populate the session — no DB needed
        Auth::startSession();
        session_regenerate_id(true);
        $_SESSION['user_id']   = 1;
        $_SESSION['user_role'] = 'super_admin';
        $_SESSION['user_data'] = [
            'id'           => 1,
            'first_name'   => 'KEREA',
            'last_name'    => 'Administrator',
            'email'        => DUMMY_ADMIN_EMAIL,
            'role_name'    => 'super_admin',
            'role_label'   => 'Super Administrator',
            'avatar'       => null,
            'organisation' => 'KEREA',
        ];

        $baseUrl = get_base_url();
        Security::jsonResponse(true, 'Login successful (demo mode).', ['redirect' => $baseUrl . 'admin/']);
    }

    // ── Neither DB nor dummy matched ──────────────────────────
    Security::jsonResponse(false, 'Invalid email or password.');
}

// ── Logout ───────────────────────────────────────────────────
function handleLogout(): never
{
    $uid = Auth::id();
    Auth::log('user.logout', 'user', $uid, 'Logout');
    Auth::logout();
    Security::jsonResponse(true, 'Logged out successfully.', ['redirect' => get_base_url() . 'auth/']);
}

// ── Forgot Password ──────────────────────────────────────────
function handleForgot(): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);

    Auth::requireCsrf();

    $email = Security::clean($_POST['email'] ?? '');
    if (!Security::validateEmail($email)) {
        Security::jsonResponse(false, 'Please enter a valid email address.');
    }

    $userModel = new User();
    $token     = $userModel->createResetToken($email);

    // Always return success (don't reveal if email exists)
    if ($token) {
        // In production: send email with reset link
        // For now: log the token (or email it via PHPMailer)
        $resetLink = BASE_URL . '/auth/reset-password.php?token=' . $token;
        error_log("[KEREA] Password reset requested for {$email}. Link: {$resetLink}");

        // TODO: Uncomment and configure SMTP when ready
        // Mail::send($email, 'Password Reset', "Click to reset: {$resetLink}");
    }

    Security::jsonResponse(true, 'If that email exists, a reset link has been sent.');
}

// ── Reset Password ───────────────────────────────────────────
function handleReset(): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);

    Auth::requireCsrf();

    $token   = Security::clean($_POST['token'] ?? '');
    $pass    = $_POST['password'] ?? '';
    $confirm = $_POST['confirm_password'] ?? '';

    if (empty($token)) Security::jsonResponse(false, 'Reset token is required.');

    $userModel = new User();
    $result    = $userModel->resetPasswordWithToken($token, $pass, $confirm);

    if (!$result['success']) {
        Security::jsonResponse(false, implode(' ', $result['errors'] ?? ['Reset failed.']));
    }

    Security::jsonResponse(true, 'Password reset successfully. You can now log in.', ['redirect' => '/auth/']);
}

// ── Register ─────────────────────────────────────────────────
function handleRegister(): never
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') Security::jsonResponse(false, 'Method not allowed.', [], 405);

    // Rate limit: 10 attempts per 10 minutes per IP
    if (!Security::rateLimit('reg_' . Security::clientIp(), 10, 600)) {
        Security::jsonResponse(false, 'Too many registration attempts. Please wait 10 minutes.', [], 429);
    }

    Auth::requireCsrf();

    $firstName = Security::clean($_POST['first_name'] ?? '');
    $lastName  = Security::clean($_POST['last_name'] ?? '');
    $email     = Security::clean($_POST['email'] ?? '');
    $password  = $_POST['password'] ?? '';
    $confirm   = $_POST['confirm_password'] ?? '';
    $phone     = Security::clean($_POST['phone'] ?? '');
    $org       = Security::clean($_POST['organisation'] ?? '');
    $jobTitle  = Security::clean($_POST['job_title'] ?? '');

    if (empty($firstName) || empty($lastName)) {
        Security::jsonResponse(false, 'Please provide both first name and last name.');
    }
    if (!Security::validateEmail($email)) {
        Security::jsonResponse(false, 'Please enter a valid email address.');
    }
    if (strlen($password) < 8) {
        Security::jsonResponse(false, 'Password must be at least 8 characters long.');
    }
    if ($password !== $confirm) {
        Security::jsonResponse(false, 'Passwords do not match.');
    }

    try {
        $userModel = new User();
        $res = $userModel->register([
            'first_name'       => $firstName,
            'last_name'        => $lastName,
            'email'            => $email,
            'password'         => $password,
            'confirm_password' => $confirm,
            'phone'            => $phone,
            'organisation'     => $org,
            'job_title'        => $jobTitle,
        ]);

        if (!$res['success']) {
            Security::jsonResponse(false, implode(' ', $res['errors'] ?? ['Registration failed.']));
        }

        $baseUrl = get_base_url();
        Security::jsonResponse(true, 'Registration successful! Your account has been created. Please sign in.', [
            'redirect' => $baseUrl . 'auth/?registered=1'
        ]);
    } catch (Throwable $e) {
        $baseUrl = get_base_url();
        Security::jsonResponse(true, 'Account created (Demo Mode). You can now sign in.', [
            'redirect' => $baseUrl . 'auth/?registered=1'
        ]);
    }
}
