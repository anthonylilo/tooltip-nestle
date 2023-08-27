jQuery(document).ready(function ($) {
  // Make an AJAX request to get the glossary data
  $.ajax({
    url: "http://localhost/paginas/nestle/get-glossary",
    success: function (data) {
      // Split the words in the document
      const wordsInDocument = $("#block-glossary-content").text().split(/\s+/);

      // Filter the matching words from the glossary data
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

      // Get the matching words from the glossary data
      const matchingWords = filterMatchingWords(data, wordsInDocument);

      // Place tooltips for the matching words in the document
      const placeTooltip = (array, text) => {
        const openTag = '<div class="tooltip">';
        const closeTag = "</div>";

        let result = text;
        const tooltipsAdded = [];

        array.forEach((item) => {
          const regex = new RegExp(`\\b${item.title}\\b`, "gi");
          const tooltipContent =
            item.description.length > 100
              ? item.description.substring(0, 100) +
                "... <span class='read-more'>Read more &#128072;</span>"
              : item.description;

          let match;
          while ((match = regex.exec(result)) !== null) {
            const matchIndex = match.index;
            const matchLength = match[0].length;

            let isInTooltip = false;

            tooltipsAdded.forEach(({ start, end }) => {
              if (matchIndex >= start && matchIndex < end) {
                isInTooltip = true;
              }
            });

            if (!isInTooltip) {
              // Add the tooltip for the match
              const tooltip = `${openTag}<a href="http://localhost/paginas/nestle/glossary-term/${item.id}">${match[0]}<span class="tooltiptext">${tooltipContent}</span></a>${closeTag}`;

              // Insert the tooltip into the text
              result =
                result.slice(0, matchIndex) +
                tooltip +
                result.slice(matchIndex + matchLength);

              // Update the tooltipsAdded array
              tooltipsAdded.push({
                start: matchIndex,
                end: matchIndex + tooltip.length,
              });
            }
          }
        });

        return result;
      };

      // Get the content of the glossary block
      let content = $("#block-glossary-content").html();
      // Place tooltips in the content
      content = placeTooltip(matchingWords, content);
      // Update the content of the glossary block
      $("#block-glossary-content").html(content);
    },
    error: function (xhr, status, error) {
      // Log any AJAX errors
      console.log("Error AJAX:", error);
    },
  });
});
