<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Logging out...</title>
</head>
<body>
    <script>
        fetch(<?php echo json_encode($casdoorLogoutUrl); ?>, { credentials: 'include', mode: 'no-cors' })
            .finally(function () { window.location = <?php echo json_encode($loginUrl); ?>; });
    </script>
</body>
</html>
