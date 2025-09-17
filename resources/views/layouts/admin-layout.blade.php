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

<link rel="stylesheet" href="{{asset('cropper/cropper.min.css')}}">
<script src="{{asset('cropper/cropper.min.js')}}"></script>
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
// обрезка фото руководства
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.getElementById('file');
        const imagePreview = document.getElementById('image-preview');
        const cropperContainer = document.getElementById('image-cropper-container');
        const cropBtn = document.getElementById('crop-btn');
        const cancelCropBtn = document.getElementById('cancel-crop-btn');
        const croppedImageData = document.getElementById('cropped-image-data');
        let cropper;

        // Обработка выбора файла
        fileInput.addEventListener('change', function(e) {
            const files = e.target.files;

            if (files && files.length > 0) {
                const file = files[0];

                // Проверяем, является ли файл изображением
                if (!file.type.match('image.*')) {
                    alert('Пожалуйста, выберите файл изображения');
                    return;
                }

                const reader = new FileReader();

                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                    cropperContainer.classList.remove('hidden');

                    // Инициализируем Cropper.js
                    if (cropper) {
                        cropper.destroy();
                    }

                    cropper = new Cropper(imagePreview, {
                        aspectRatio: 3/4, // Соотношение сторон (например, 3:4 для портрета)
                        viewMode: 1,
                        guides: true,
                        movable: true,
                        zoomable: true,
                        rotatable: true,
                        scalable: true
                    });
                };

                reader.readAsDataURL(file);
            }
        });

        // Обработка кнопки обрезки
        cropBtn.addEventListener('click', function() {
            if (cropper) {
                // Получаем обрезанное изображение в формате base64
                const canvas = cropper.getCroppedCanvas({
                    width: 300,  // Ширина конечного изображения
                    height: 400  // Высота конечного изображения
                });

                if (canvas) {
                    // Конвертируем canvas в base64 строку
                    const base64Image = canvas.toDataURL('image/jpeg');
                    croppedImageData.value = base64Image;

                    // Создаем миниатюру для предпросмотра
                    imagePreview.src = base64Image;

                    // Отключаем cropper
                    cropper.destroy();
                    cropper = null;

                    // Меняем видимость кнопок
                    cropBtn.classList.add('hidden');
                    cancelCropBtn.textContent = 'Изменить обрезку';
                }
            }
        });

        // Обработка кнопки отмены/изменения обрезки
        cancelCropBtn.addEventListener('click', function() {
            if (cropper) {
                // Если cropper активен, отменяем обрезку
                cropper.destroy();
                cropper = null;
                cropperContainer.classList.add('hidden');
                fileInput.value = '';
                croppedImageData.value = '';
                cropBtn.classList.remove('hidden');
                cancelCropBtn.textContent = 'Отмена';
            } else {
                // Если обрезка уже выполнена, позволяем изменить её
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        imagePreview.src = event.target.result;
                        cropperContainer.classList.remove('hidden');
                        cropper = new Cropper(imagePreview, {
                            aspectRatio: 3/4,
                            viewMode: 1,
                            guides: true,
                            movable: true,
                            zoomable: true,
                            rotatable: true,
                            scalable: true
                        });
                        cropBtn.classList.remove('hidden');
                        cancelCropBtn.textContent = 'Отмена';
                    };
                    reader.readAsDataURL(file);
                }
            }
        });

        // Обработка отправки формы
        document.querySelector('form').addEventListener('submit', function(e) {
            // Если выбрано изображение, но не выполнена обрезка
            if (fileInput.files.length > 0 && !croppedImageData.value && cropper) {
                e.preventDefault();
                alert('Пожалуйста, обрежьте изображение перед отправкой');
            }
        });
    });
</script>

</body>
</html>
