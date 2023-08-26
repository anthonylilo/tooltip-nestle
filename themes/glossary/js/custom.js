jQuery(document).ready(function ($) {
  $.ajax({
    //PUT YOUR LOCAL PATH
    url: "http://localhost/paginas/nestle/get-glossary",
    success: function (data) {
      const wordsInDocument = $("#block-glossary-content").text().split(/\s+/);

      const filterMatchingWords = (compareArray, documentWords) => {
        let result = [];
        compareArray.forEach((entry) => {
          const filteredTitle = documentWords.filter((word) => {
            return (
              word.toLowerCase() === entry.title.toLowerCase().replace(".", "")
            );
          })[0];
          if (filteredTitle) result.push({ ...entry, title: filteredTitle });
        });
        return result;
      };

      const matchingWords = filterMatchingWords(data, wordsInDocument);

      const placeTooltip = (array, text) => {
        array.forEach((item) => {
          const regex = new RegExp(`\\b${item.title}\\b`, "gi");
          const tooltipContent =
            item.description.length > 100
              ? item.description.substring(0, 100) +
                " <span class='read-more'>Read more...</span>"
              : item.description;
          text = text.replace(regex, (match) => {
            return `<div class="tooltip"><a href="http://localhost/paginas/nestle/glossary-term/${item.id}">${match}<span class="tooltiptext">${tooltipContent}</span></a></div>`;
          });
        });
        return text;
      };

      let content = $("#block-glossary-content").html();
      content = placeTooltip(matchingWords, content);
      $("#block-glossary-content").html(content);
    },
    error: function (xhr, status, error) {
      console.log("Error AJAX:", error);
    },
  });
});
