document.addEventListener('DOMContentLoaded', function() {
    // Показываем алерты и скрываем через 5 секунд
    const alerts = document.querySelectorAll('.alert');
    if (alerts.length > 0) {
        alerts.forEach(alert => {
            setTimeout(() => {
                alert.style.opacity = '0';
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 500);
            }, 5000);
        });
    }
    
    // Валидация форм
    const forms = document.querySelectorAll('.form');
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const requiredFields = form.querySelectorAll('input[required]');
            let isValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    const formGroup = field.closest('.form-group');
                    
                    // Удаляем существующие сообщения об ошибках
                    const existingError = formGroup.querySelector('.form-error');
                    if (existingError) {
                        existingError.remove();
                    }
                    
                    // Добавляем сообщение об ошибке
                    const errorMsg = document.createElement('div');
                    errorMsg.className = 'form-error';
                    errorMsg.textContent = 'This field is required';
                    formGroup.appendChild(errorMsg);
                    
                    // Стили для ошибки
                    field.style.borderColor = 'var(--error-color)';
                }
            });
            
            if (!isValid) {
                e.preventDefault();
            }
        });
        
        // Сброс стилей ошибок при вводе
        const inputs = form.querySelectorAll('input');
        inputs.forEach(input => {
            input.addEventListener('input', function() {
                input.style.borderColor = '';
                const formGroup = input.closest('.form-group');
                const error = formGroup.querySelector('.form-error');
                if (error) {
                    error.remove();
                }
            });
        });
    });
}); 