function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'en',
      includedLanguages: 'en,tl', // Include the languages you want to support
      layout: google.translate.TranslateElement.InlineLayout.SIMPLE, // You can adjust the layout
      autoDisplay: false, // Don't auto-display the widget, we will trigger it with JavaScript
    }, 'google_translate_element');
  }