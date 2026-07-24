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

header('Content-Type: application/json');
Auth::startSession();

$action = $_GET['action'] ?? $_POST['action'] ?? '';

match ($action) {
    'login'   => handleLogin(),
    'logout'  => handleLogout(),
    'forgot'  => handleForgot(),
    'reset'   => handleReset(),
    default   => Security::jsonResponse(false, 'Unknown action.', [], 400),
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

    $userModel = new User();
    $user      = $userModel->authenticate($email, $password);

    if (!$user) {
        Security::jsonResponse(false, 'Invalid email or password.');
    }

    Auth::login($user);
    Auth::log('user.login', 'user', $user['id'], 'Successful login');

    // Determine redirect based on role
    $redirect = in_array($user['role_name'], ['super_admin','admin','content_manager'])
        ? '/admin/'
        : '/membership/dashboard/';

    Security::jsonResponse(true, 'Login successful.', ['redirect' => $redirect]);
}

// ── Logout ───────────────────────────────────────────────────
function handleLogout(): never
{
    $uid = Auth::id();
    Auth::log('user.logout', 'user', $uid, 'Logout');
    Auth::logout();
    Security::jsonResponse(true, 'Logged out successfully.', ['redirect' => '/auth/']);
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
