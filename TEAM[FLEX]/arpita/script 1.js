async function fetchCryptoPrices() {
    try {
        const response = await fetch('https://api.binance.com/api/v3/ticker/price');
        const data = await response.json();

        // Extract BTC and ETH prices
        const btcPrice = data.find(coin => coin.symbol === 'BTCUSDT');
        const ethPrice = data.find(coin => coin.symbol === 'ETHUSDT');

        if (btcPrice) {
            document.getElementById('btc-price').textContent = `$${parseFloat(btcPrice.price).toFixed(2)}`;
        }
        if (ethPrice) {
            document.getElementById('eth-price').textContent = `$${parseFloat(ethPrice.price).toFixed(2)}`;
        }
    } catch (error) {
        console.error('Error fetching crypto prices:', error);
    }
}

// Fetch prices every 5 seconds
setInterval(fetchCryptoPrices, 5000);

// Fetch immediately when the page loads
fetchCryptoPrices();

