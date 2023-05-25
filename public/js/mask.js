$(document).ready(function () {
  $("#phone").inputmask("(99) 9999[9]-9999");
  $("#document").inputmask("999.999.999-99");
  // $("#amount").inputmask({
  //   alias: "currency",
  //   prefix: "$",
  //   placeholder: "0",
  // });
});

function validateCPF(cpf) {
  // Remove caracteres não numéricos do CPF
  cpf = cpf.replace(/\D/g, '');

  // Verifica se o CPF possui 11 dígitos
  if (cpf.length !== 11) {
    return false;
  }

  // Verifica se todos os dígitos são iguais, o que torna o CPF inválido
  if (/^(\d)\1+$/.test(cpf)) {
    return false;
  }

  // Validação do primeiro dígito verificador
  let sum = 0;
  for (let i = 0; i < 9; i++) {
    sum += parseInt(cpf.charAt(i)) * (10 - i);
  }
  let digit = 11 - (sum % 11);
  if (digit === 10 || digit === 11) {
    digit = 0;
  }
  if (digit !== parseInt(cpf.charAt(9))) {
    return false;
  }

  // Validação do segundo dígito verificador
  sum = 0;
  for (let i = 0; i < 10; i++) {
    sum += parseInt(cpf.charAt(i)) * (11 - i);
  }
  digit = 11 - (sum % 11);
  if (digit === 10 || digit === 11) {
    digit = 0;
  }
  if (digit !== parseInt(cpf.charAt(10))) {
    return false;
  }

  // CPF válido
  return true;
}

document.getElementById('document').addEventListener('blur', function () {
  const cpfInput = this.value;
  const cpfError = document.getElementById('cpf-error');
  const submitButton = document.getElementById('submit-button');

  if (validateCPF(cpfInput)) {
    // CPF válido
    cpfError.textContent = '';
    this.classList.remove('border-red-500');
    this.classList.add('border-green-500');
    submitButton.disabled = false;
  } else {
    // CPF inválido
    cpfError.textContent = 'CPF inválido';
    this.classList.remove('border-green-500');
    this.classList.add('border-red-500');
    submitButton.disabled = true;
  }
});