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

@include('components.modal-confirmation')
<script>
    function openModal(actionUrl, entityText = 'этого объекта') {
        const form = document.getElementById('delete-form');
        form.action = actionUrl;

        // Меняем текст в модалке
        const textEl = document.getElementById('delete-modal-text');
        textEl.textContent = `Вы уверены, что хотите удалить ${entityText}?`;

        document.getElementById('delete-modal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('delete-modal').classList.add('hidden');
    }

    /*Генератор пароля для Юзера*/

   const genPassBtn = document.getElementById('generate-password');
   if (genPassBtn) {
       genPassBtn.addEventListener('click', function () {
           const password = generatePassword(8);
           document.getElementById('password').value = password;
           document.getElementById('password_confirmation').value = password;
       });
   }

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
