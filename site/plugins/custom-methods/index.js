/* Скрывает ошибку интерфейса бэкапов */
const hideBackupsErrorDialog = () => {
  const { fetch: originalFetch } = window;

  // Скрываем все порталы (диалоги), если в них появляется текст ошибки или бэкапа
  const style = document.createElement('style');
  style.innerHTML = `
      .hide-backup-error .k-dialog-portal {
          display: none !important;
          opacity: 0 !important;
          pointer-events: none !important;
      }
  `;
  document.head.appendChild(style);

  window.fetch = async (...args) => {
      const url = args[0] instanceof Request ? args[0].url : args[0];
      const isDeleteBackup = url && url.includes('backups/delete-backup');

      if (isDeleteBackup) {
          // Перед запросом вешаем класс на body, который "заглушит" появление попапа
          document.body.classList.add('hide-backup-error');
      }

      const response = await originalFetch(...args);

      if (isDeleteBackup) {
          console.log('🎯 Бэкап удален, перезагружаем без мерцания...');

          // Маленькая задержка перед релоадом не нужна,
          // так как CSS уже блокирует отображение ошибки
          window.location.reload();
      }

      return response;
  };
}

hideBackupsErrorDialog();
