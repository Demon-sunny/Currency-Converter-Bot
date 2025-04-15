
# Currency Converter Bot 💱🤖
A sleek and modern web app that allows users to quickly convert currencies in real-time using live exchange rates. The app includes an AI-powered chatbot that guides users through conversions, explains forex terms, and offers currency insights powered by the **Gemini 2.0 Flash API**.

## Features ✨

-  Real-Time Currency Conversion**: Convert between over 150 currencies using live exchange rates  
-  Global Coverage**: Supports most major and minor currencies worldwide  
-  AI Chatbot Assistant**: Get help, explanations, and insights from the Gemini 2.0 Flash-powered chatbot  
-  Conversion History**: Track your past conversions locally  
-  Responsive Design**: Works seamlessly across all devices  
-  Forex Education**: Ask the bot to explain exchange rates, currency trends, and more  

## Tech Stack 🛠️

- HTML5  
- CSS3 (modern responsive styles)  
- JavaScript (ES6+)  
- Gemini 2.0 Flash API for AI chatbot  
- [Frankfurter Currency API]() or similar for live rates  
- Local Storage for history persistence  

## Live Demo 🌐

Coming soon or host your own locally (see below).  

## Getting Started 🚀

### Prerequisites

- A modern web browser (Chrome, Firefox, Safari, Edge)  
- API keys:
  - One for currency exchange rates (e.g., [ExchangeRate-API](https://www.exchangerate-api.com/))
  - One for the Gemini AI Chatbot ([Get it here](https://makersuite.google.com/app/apikey))

### Installation

```bash
git clone https://github.com/yourusername/currency-converter-bot.git
cd currency-converter-bot
```

1. Open `index.html` in your browser  
2. Replace API placeholders:
   - In `js/chatbot.js`, set your `YOUR_GEMINI_API_KEY`
   - In `js/script.js`, set your `YOUR_EXCHANGE_API_KEY`

⚠️ **Important**: Never expose your API keys in public repositories. Use local `.env` files or secured methods for production.

## Project Structure 📁

```
currency-converter-bot/
├── index.html
├── css/
│   └── styles.css
├── js/
│   ├── script.js         # Conversion logic
│   └── chatbot.js        # AI assistant
└── README.md
```

## Usage 💡

1. **Convert Currency**:
   - Select currencies and enter amount
   - Get instant conversion results based on live rates  

2. **Chatbot Assistant**:
   - Click the chat icon in the corner
   - Ask about currency trends, exchange rate definitions, or get help  

3. **Track History**:
   - View and manage your conversion history  
   - Stored locally for privacy and speed  

## Screenshots 📸
Converter Interface:
![WhatsApp Image 2025-04-07 at 16 35 05_8c046b20](https://github.com/user-attachments/assets/d0039831-dc33-4764-8f63-cacef4369db6)

(![WhatsApp Image 2025-04-04 at 01 35 05_8b0b364e](https://github.com/user-attachments/assets/fd2aacb1-be99-445b-9418-27f847df6899)
)  
![WhatsApp Image 2025-04-07 at 16 35 04_7796aa91](https://github.com/user-attachments/assets/53d7c6dd-c869-4f8b-a373-89902505b631)


## Contributing 🤝

Pull requests are welcome! For major changes, open an issue first to discuss what you'd like to change.

## License 📄

This project is licensed under the MIT License – see the [LICENSE](LICENSE) file for details.

## Acknowledgments 🙏

- [ExchangeRate-API](https://www.Frankfurter Currency-api.com/) for currency data  
- [Google Gemini](https://ai.google.dev/) for the chatbot API  
- [Font Awesome](https://fontawesome.com/) for icons  

## Support 💬

If you run into issues or have ideas, open an issue on GitHub!
