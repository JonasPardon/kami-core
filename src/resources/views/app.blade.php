<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ mix('/css/app.css') }}" rel="stylesheet">
    <script src="{{ mix('/js/kami.js') }}" defer></script>
</head>
<body>

<script>
    window.laravel = <?php echo json_encode(['csrfToken' => csrf_token()]); ?>
</script>

@inertia

</body>
</html>
