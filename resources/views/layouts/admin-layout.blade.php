<!DOCTYPE html>
<html lang="ru" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/logo.svg"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <title>Администрирование</title>
</head>
<body class="bg-gray-900 text-white h-screen flex">

<!-- Админ навбар -->

@include('components.admin-navbar')

<!-- Admin content-->

@yield('content')

<!-- Сообщения -->
@include('components.messagebox')

<script>
    function openModal(userId) {
        const form = document.getElementById('delete-form'); //Закидываем в модальное окно нужный ID пользователя для удаления
        form.action = `/admin/users/${userId}`; // Или blade: "{{ route('admin.user.destroy', '') }}/" + userId;
        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }

    document.getElementById('generate-password').addEventListener('click', function () {
        const password = generatePassword(8); // длина 8 символов
        document.getElementById('password').value = password;
        document.getElementById('password_confirmation').value = password;
    });

    function generatePassword(length) {
        const chars = 'abcdefghijkmnopqrstuvwxyzABCDEFGHJKMNOPQRSTUVWXYZ0123456789'; // удалил I L l чтобы не путаться т.к иногда отображаются одинаково или очень похожи
        let password = '';
        for (let i = 0; i < length; i++) {
            password += chars.charAt(Math.floor(Math.random() * chars.length));
        }
        return password;
    }
</script>

</body>
</html>
