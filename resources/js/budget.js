function subtract()
{
    var txtNumber = document.getElementById("txtNumber");
    var newNumber = parseInt(txtNumber.value) - 1;
    txtNumber.value = newNumber;
}