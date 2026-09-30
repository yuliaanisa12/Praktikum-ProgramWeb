<?php

$page_title = "Login Petugas";

require_once __DIR__ . '/../includes/header.php';

$error = $_SESSION['login_error'] ?? null;

unset($_SESSION['login_error']);

?>

<section class="auth-card">

    <h2>Login Petugas</h2>

    <?php if ($error): ?>

        <div class="alert alert-danger">
            <?php echo e($error); ?>
        </div>

    <?php endif; ?>


    <form action="/auth/proses_login.php" method="POST">

        <?php echo csrf_field(); ?>


        <!-- Username -->

        <div class="form-group">

            <label for="username">
                Username
            </label>

            <input
                type="text"
                id="username"
                name="username"
                value="<?php echo e($_POST['username'] ?? ''); ?>"
                required
                autofocus
            >

        </div>


        <!-- Password -->

        <div class="form-group">

            <label for="password">
                Password
            </label>

            <input
                type="password"
                id="password"
                name="password"
                required
            >

        </div>


        <!-- Ingat Saya -->

        <div class="remember">

            <input
                type="checkbox"
                id="ingat"
                name="ingat"
            >

            <label for="ingat">
                Ingat Saya
            </label>

        </div>


        <!-- Tombol -->

        <button type="submit">
            Masuk
        </button>

    </form>


    <div class="register-link">

        Belum punya akun?

        <a href="/auth/register.php">
            Daftar di sini
        </a>

    </div>

</section>


<?php

require_once __DIR__ . '/../includes/footer.php';

?>