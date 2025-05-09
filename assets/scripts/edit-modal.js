document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-dialog-target="edit-modal"]').forEach(button => {
        button.addEventListener('click', () => {
            const title = button.getAttribute('data-title');
            const timesheet = button.getAttribute('data-timesheet');
            const priority = button.getAttribute('data-priority');
            const info = button.getAttribute('data-info');

            document.getElementById('editTaskName').value = title;
            document.getElementById('editTaskTimesheet').value = timesheet;
            document.getElementById('editTaskPriority').value = priority;
            document.getElementById('editTaskInfo').value = info;
        });
    });
});