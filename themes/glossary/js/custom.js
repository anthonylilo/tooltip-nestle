(function ($, Drupal) {
  Drupal.behaviors.glossaryTooltip = {
    attach: function (context, settings) {
      $(document).ready(function () {
        $.ajax({
          url: "http://localhost/paginas/nestle/get-glossary",
          success: function (data) {
            const wordsInDocument = $(".layout-content").text().split(/\s+/);
            const titles = data.map((entry) => entry.title);
            const filterMatchingWords = (compareArray, documentWords) => {
              let result = [];
              compareArray.forEach((entry) => {
                result.push(
                  documentWords.filter((word) => {
                    return (
                      word.toLowerCase() ===
                      entry.toLowerCase().replace(".", "")
                    );
                  })[0]
                );
              });
              return result;
            };
            const matchingWords = filterMatchingWords(titles, wordsInDocument);
            const description = data.map((entry) => entry.description);
            const id = data.map((entry) => entry.id);
            const placeTooltip = (array, text) => {
              let newText = text;
              array.forEach((word, index) => {
                const regex = new RegExp(`\\b${word}\\b`);
                newText = newText.replace(regex, (match) => {
                  return `<div class="tooltip"><a href="http://localhost/paginas/nestle/glossary-term/${id[index]}">${match}<span class="tooltiptext">${description[index]}</span></a></div>`;
                });
              });
              return newText;
            };
            let content = $(".layout-content").html();
            content = placeTooltip(matchingWords, content);
            $(".layout-content").html(content);
          },
          error: function (xhr, status, error) {
            console.log("Error AJAX:", error);
          },
        });
      });
    },
  };
})(jQuery, Drupal);
