<?php
require '../config/database.php';

$users = $conn->query("SELECT id, full_name FROM users ORDER BY full_name");
$periods = $conn->query("SELECT id, month, year FROM login_periods");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>IPCR Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root{--bg:#f4f6fb;--card:#fff;--accent:#2563eb}
        html,body{height:100%;font-family:'Inter',system-ui,Segoe UI,Roboto,Arial,sans-serif;background:linear-gradient(135deg,#e6f0ff 0%,#f7fbff 100%);margin:0}
        .container{min-height:100vh;display:flex;align-items:center;justify-content:center;padding:24px}
        .card{background:var(--card);border-radius:12px;box-shadow:0 10px 30px rgba(16,24,40,0.08);max-width:420px;width:100%;padding:28px}
        .brand{display:flex;align-items:center;gap:12px;margin-bottom:12px}
        .logo{width:44px;height:44px;border-radius:8px;background:linear-gradient(135deg,var(--accent),#7c3aed);display:flex;align-items:center;justify-content:center;color:#fff;font-weight:700}
        h1{font-size:20px;margin:0;color:#0f172a}
        p.lead{margin:6px 0 20px;color:#475569;font-size:14px}
        label{display:block;font-size:13px;color:#334155;margin-bottom:6px}
        select{width:100%;padding:10px 12px;border-radius:8px;border:1px solid #e6e9ef;background:#fff;font-size:14px;appearance:none}
        button{margin-top:18px;width:100%;padding:12px;border-radius:10px;border:0;background:var(--accent);color:#fff;font-weight:600;cursor:pointer;transition:transform .08s ease}
        button:disabled{opacity:0.6;cursor:not-allowed}
        .footer{margin-top:16px;text-align:center;color:#94a3b8;font-size:13px}
        @media (max-width:420px){.card{padding:20px}}
    </style>
</head>
<body>
<div class="container">
    <div class="card" role="main" aria-labelledby="login-heading">
        <div class="brand">
            <div class="logo">IP</div>
            <div>
                <h1 id="login-heading">IPCR System</h1>
                <p class="lead">Sign in gwapo haha</p>
            </div>
        </div>

        <form method="POST" action="auth.php" id="loginForm" novalidate>
            <div>
                <label for="user_id">Name</label>
                <select name="user_id" id="user_id" required autofocus>
                    <option value="" disabled selected>Choose your name</option>
                    <?php while ($u = $users->fetch_assoc()): ?>
                        <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['full_name']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div style="margin-top:12px;display:flex;gap:8px;align-items:end">
                <div style="flex:1">
                    <label for="period_month">Month</label>
                    <select name="period_month" id="period_month" required>
                        <option value="" disabled selected>Select month</option>
                        <option value="January">January</option>
                        <option value="February">February</option>
                        <option value="March">March</option>
                        <option value="April">April</option>
                        <option value="May">May</option>
                        <option value="June">June</option>
                        <option value="July">July</option>
                        <option value="August">August</option>
                        <option value="September">September</option>
                        <option value="October">October</option>
                        <option value="November">November</option>
                        <option value="December">December</option>
                    </select>
                </div>
                <div style="width:120px">
                    <label for="period_year">Year</label>
                    <select name="period_year" id="period_year" required>
                        <option value="" disabled selected>Select year</option>
                        <?php
                            $currentYear = (int)date('Y');
                            for ($y = $currentYear - 1; $y <= $currentYear + 1; $y++) {
                                echo "<option value=\"$y\">$y</option>\n";
                            }
                        ?>
                    </select>
                </div>
            </div>

            <button type="submit" id="submitBtn" disabled>Sign in</button>
        </form>

        <div class="footer">© <?= date('Y') ?> IPCR System</div>
    </div>
</div>

<script>
    (function(){
        const user = document.getElementById('user_id');
        const month = document.getElementById('period_month');
        const year = document.getElementById('period_year');
        const submit = document.getElementById('submitBtn');

        function update() {
            submit.disabled = !(user.value && month.value && year.value);
        }

        user.addEventListener('change', update);
        month.addEventListener('change', update);
        year.addEventListener('change', update);

        // enable submit on keyboard selection too
        document.getElementById('loginForm').addEventListener('submit', function(e){
            if (!user.value || !month.value || !year.value) {
                e.preventDefault();
                user.focus();
            } else {
                submit.textContent = 'Signing in...';
                submit.disabled = true;
            }
        });
    })();
</script>
</body>
</html>