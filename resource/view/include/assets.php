<script type="text/javascript">
  // Get all elements with the class "default-date-picker"
  var datePickers = document.querySelectorAll(".default-date-picker");

  // Function to set the default date
  function setDefaultDate(inputElement) {
    var editStartDate = inputElement.value;
    
    if (editStartDate === "0000-00-00") {
      var currentDate = new Date();
      var formattedDate = currentDate.toISOString().split('T')[0];
      inputElement.value = formattedDate;
    }
  }

  // Initialize date pickers and add event listeners
  datePickers.forEach(function(inputElement) {
    inputElement.addEventListener("click", function() {
      setDefaultDate(inputElement);
    });
  });
</script>
