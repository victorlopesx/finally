document.addEventListener("DOMContentLoaded", function () {
  const amountInput = document.querySelector("#amount");
  const mirrorAmountInput = document.querySelector("#mirrorAmount");

  async function fetchExchangeRate() {
    const response = await fetch(
      "https://economia.awesomeapi.com.br/json/last/USD-BRL"
    );
    const data = await response.json();
    const exchangeRate = parseFloat(data.USDBRL.bid).toFixed(2);
    return exchangeRate;
  }

  async function convertAmountToBRL() {
    const exchangeRate = await fetchExchangeRate();
    const amountUSD = parseFloat(amountInput.value.replace("$", ""));

    if (isNaN(amountUSD)) {
      mirrorAmountInput.value =
        "Erro ao converter. Por favor, tente novamente.";
    } else {
      const amountBRL = amountUSD * exchangeRate * 1.06;
      const amountBRLFormatted = new Intl.NumberFormat("pt-BR", {
        style: "currency",
        currency: "BRL",
      }).format(amountBRL);
      mirrorAmountInput.value = amountBRLFormatted;
    }
  }

  amountInput.addEventListener("input", convertAmountToBRL);
});