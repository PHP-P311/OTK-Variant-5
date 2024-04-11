$('body').on('click', '.password-checkbox', function(){
	if ($(this).is(':checked')){
		$('#password-input').attr('type', 'text');
	} else {
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

$(document).ready(function() {
    // Функция для обновления значения поля ввода при выборе элемента из списка
    function updateInput(value) {
        $('#vessel_code').val(value);
    }

    // Обработчик клика на элемент списка
    $('#vessel_list').on('click', 'li', function() {
        var selectedValue = $(this).text();
        updateInput(selectedValue);
    });

    // Функция для обновления списка сосудов
    function updateVesselList(data) {
        $('#vessel_list').empty();
        if (data.length > 0) {
            $.each(data, function(index, vessel) {
                $('#vessel_list').append('<li style="cursor: pointer;">' + vessel.vessel_name + '</li>');
            });
        } else {
            $('#vessel_list').append('<li>Пусто</li>');
        }
    }

    // Обработчик ввода в поле поиска
    $('#vessel_code').on('input', function() {
        var code = $(this).val();
        $.ajax({
            url: './vendor/search_vessel.php',
            method: 'POST',
            data: {code: code},
            success: function(response) {
                updateVesselList(response);
            }
        });
    });
});