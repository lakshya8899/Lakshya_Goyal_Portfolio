let recycledCount = 0;
  let totalItems = 0;

  function setTotalItems() {
    const input = document.getElementById('totalInput').value;
    totalItems = parseInt(input) || 0;
    document.getElementById('totalItems').textContent = totalItems;
    recycledCount = 0; // Reset recycled count when setting a new total
    document.getElementById('recycledCount').textContent = recycledCount;
    updateProgressBar();
  }

  function addRecycledItem() {
    if (totalItems > 0 && recycledCount < totalItems) {
      recycledCount++;
      document.getElementById('recycledCount').textContent = recycledCount;
      updateProgressBar();
    }
  }

  function resetTracker() {
    totalItems = 0;
    recycledCount = 0;
    document.getElementById('totalItems').textContent = totalItems;
    document.getElementById('recycledCount').textContent = recycledCount;
    updateProgressBar();
    document.getElementById('totalInput').value = ''; // Clear input field
  }

  function updateProgressBar() {
    const progressBar = document.getElementById('progressBar');
    const progress = totalItems > 0 ? (recycledCount / totalItems) * 100 : 0;
    progressBar.style.width = progress + '%';
    progressBar.textContent = progress.toFixed(2) + '%';
  }