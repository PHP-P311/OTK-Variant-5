// Добавляем обработчик события клика для элементов с классом 'password-checkbox' внутри элемента 'body'
$('body').on('click', '.password-checkbox', function(){
    // Проверяем, выбран ли текущий элемент checkbox
	if ($(this).is(':checked')){
        // Если выбран, меняем тип поля ввода на 'text', чтобы отобразить пароль
		$('#password-input').attr('type', 'text');
	} else {
        // Если не выбран, меняем тип поля ввода на 'password', чтобы скрыть пароль
		$('#password-input').attr('type', 'password');
	}
});

document.addEventListener("DOMContentLoaded", function() {
    // Получаем ссылки на элементы DOM
    var typeOneRadio = document.getElementById("type_one");
    var typeTwoRadio = document.getElementById("type_two");
    var formForOne = document.querySelector(".form_for_one");
    var formForTwo = document.querySelector(".form_for_two");
    var buttonCreateClient = document.querySelector(".create_client");
	

    // Добавляем обработчик события для радиокнопки type_one
    typeOneRadio.addEventListener("change", function() {
        if (this.checked) {
            // Если радиокнопка выбрана, показываем форму для ФЛ и скрываем форму для ЮР
            formForOne.style.display = "flex";
            formForTwo.style.display = "none";
			buttonCreateClient.style.display = "block";
            // Снимаем выбор с радиокнопки type_two
            typeTwoRadio.checked = false;
        }
    });

    // Добавляем обработчик события для радиокнопки type_two
    typeTwoRadio.addEventListener("change", function() {
        if (this.checked) {
            // Если радиокнопка выбрана, показываем форму для ЮР и скрываем форму для ФЛ
            formForTwo.style.display = "flex";
            formForOne.style.display = "none";
			buttonCreateClient.style.display = "block";
            // Снимаем выбор с радиокнопки type_one
            typeOneRadio.checked = false;
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Получаем ссылки на элементы DOM
    var createClientP = document.querySelector(".create_client_p");
    var modalCreateClient = document.querySelector(".modal_create_client");
    var overlay = document.querySelector(".overlay");

    // Добавляем обработчик клика по элементу create_client_p
    createClientP.addEventListener("click", function() {
        // Изменяем стили элемента overlay
        overlay.style.left = "0";
		modalCreateClient.style.display = "block";
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Получаем ссылки на элементы DOM
    var buttonCloseModalCreateClient = document.querySelector(".close_modal_create_client");
    var modalCreateClient = document.querySelector(".modal_create_client");
    var overlay = document.querySelector(".overlay");

    // Добавляем обработчик клика по элементу create_client_p
    buttonCloseModalCreateClient.addEventListener("click", function() {
        // Изменяем стили элемента overlay
        overlay.style.left = "-100%";
		modalCreateClient.style.display = "none";
    });
});

// Первая часть скрипта для работы с ФЛ
$(document).ready(function() {
    // Функция для обновления значения поля ввода при выборе элемента из списка
    function updateInput(value) {
        $('#vessel_code').val(value);
    }

    // Функция для обновления списка ФЛ
    function updateFizList(data) {
        $('#vessel_list').empty();
        if (data.length > 0) {
            $.each(data, function(index, vessel) {
                $('#vessel_list').append('<li style="cursor: pointer;">' + vessel.vessel_name + '</li>');
            });
            // Показываем список ФЛ, если есть результаты поиска
            $('#vessel_list').css('display', 'block');
        } else {
            $('#vessel_list').append('<li>Пусто</li>');
        }
    }

    // Обработчик ввода в поле поиска ФЛ
    $('#vessel_code').on('input', function() {
        var code = $(this).val();
        $.ajax({
            url: './vendor/search_vessel.php',
            method: 'POST',
            data: {code: code},
            success: function(response) {
                updateFizList(response);
            }
        });
    });

    // Обработчик клика на элемент списка ФЛ
    $('#vessel_list').on('click', 'li', function() {
        var selectedValue = $(this).text();
        updateInput(selectedValue);
        // Скрываем список ФЛ после выбора элемента
        $('#vessel_list').css('display', 'none');
    });
});

// Вторая часть скрипта для работы с ФИО ФЛ
$(document).ready(function() {
    // Функция для обновления значения поля ввода при выборе элемента из списка ФИО ФЛ
    function updateInput(value) {
        $('#fullname').val(value);
    }

    // Функция для обновления списка ФИО ФЛ
    function updateFizList(data) {
        $('#fiz_list').empty();
        if (data.length > 0) {
            $.each(data, function(index, vessel) {
                $('#fiz_list').append('<li style="cursor: pointer;">' + vessel.fullname + '</li>');
            });
            // Показываем список ФИО ФЛ, если есть результаты поиска
            $('#fiz_list').css('display', 'block');
        } else {
            $('#fiz_list').append('<li>Пусто</li>');
        }
    }

    // Обработчик ввода в поле поиска ФИО ФЛ
    $('#fullname').on('input', function() {
        var code = $(this).val();
        $.ajax({
            url: './vendor/search_fiz.php',
            method: 'POST',
            data: {code: code},
            success: function(response) {
                updateFizList(response);
            }
        });
    });

    // Обработчик клика на элемент списка ФИО ФЛ
    $('#fiz_list').on('click', 'li', function() {
        var selectedValue = $(this).text();
        updateInput(selectedValue);
        // Скрываем список ФИО ФЛ после выбора элемента
        $('#fiz_list').css('display', 'none');
    });
});

// Третья часть скрипта для работы с юридическими лицами
$(document).ready(function() {
    // Функция для обновления значения поля ввода при выборе элемента из списка юридических лиц
    function updateInput(value) {
        $('#company_name').val(value);
    }

    // Функция для обновления списка юридических лиц
    function updateYurList(data) {
        $('#yur_list').empty();
        if (data.length > 0) {
            $.each(data, function(index, vessel) {
                $('#yur_list').append('<li style="cursor: pointer;">' + vessel.company_name + '</li>');
            });
            // Показываем список юридических лиц, если есть результаты поиска
            $('#yur_list').css('display', 'block');
        } else {
            $('#yur_list').append('<li>Пусто</li>');
        }
    }

    // Обработчик ввода в поле поиска юридических лиц
    $('#company_name').on('input', function() {
        var code = $(this).val();
        $.ajax({
            url: './vendor/search_yur.php',
            method: 'POST',
            data: {code: code},
            success: function(response) {
                updateYurList(response);
            }
        });
    });

    // Обработчик клика на элемент списка юридических лиц
    $('#yur_list').on('click', 'li', function() {
        var selectedValue = $(this).text();
        updateInput(selectedValue);
        // Скрываем список юридических лиц после выбора элемента
        $('#yur_list').css('display', 'none');
    });
});

document.addEventListener("DOMContentLoaded", function() {
    // Получаем ссылки на элементы DOM
    var typeOneRadio = document.getElementById("type_fiz");
    var typeTwoRadio = document.getElementById("type_yur");
    var formForOne = document.querySelector(".for_fiz");
    var formForTwo = document.querySelector(".for_yur");
    var fullnameInput = document.getElementById("fullname");
    var companyNameInput = document.getElementById("company_name");
	

    // Добавляем обработчик события для радиокнопки type_one
    typeOneRadio.addEventListener("change", function() {
        if (this.checked) {
            // Если радиокнопка выбрана, показываем форму для ФЛ и скрываем форму для ЮР
            formForOne.style.display = "flex";
            formForTwo.style.display = "none";
            // Снимаем выбор с радиокнопки type_two
            typeTwoRadio.checked = false;
            companyNameInput.value = "";
        }
    });

    // Добавляем обработчик события для радиокнопки type_two
    typeTwoRadio.addEventListener("change", function() {
        if (this.checked) {
            // Если радиокнопка выбрана, показываем форму для ЮР и скрываем форму для ФЛ
            formForTwo.style.display = "flex";
            formForOne.style.display = "none";
            // Снимаем выбор с радиокнопки type_one
            typeOneRadio.checked = false;
            fullnameInput.value = "";
        }
    });
});