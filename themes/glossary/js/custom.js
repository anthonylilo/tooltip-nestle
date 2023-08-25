(function ($, Drupal) {
  Drupal.behaviors.glossaryTooltip = {
    attach: function (context, settings) {
      $(document).ready(function () {
        $.ajax({
          url: "http://localhost/paginas/nestle/get-glossary",
          success: function (data) {
            /*selecciona el texto del dom y lo separa en un array*/
            const wordsInDocument = $(".layout-content").text().split(/\s+/);
            //saco los titles y los meto en un array
            const titles = data.map((entry) => entry.title);
            /* selecciona los elementos de documentWords que coincidan con los
            elementos de compareArray y retorna el resultado */
            const filterMatchingWords = (compareArray, documentWords) => {
              let result = [];
              compareArray.forEach((entry) => {
                result.push(
                  documentWords.filter((word) => {
                    return word.toLowerCase() === entry.toLowerCase();
                  })[0]
                );
              });
              return result;
            };
            /* se ejecuta la función comparando el array titles contra el array
            wordsInDocument*/
            const matchingWords = filterMatchingWords(titles, wordsInDocument);
            /* acá envuelve las palabras del dom que coincidan con el array
            con la etiqueta <span> y retorna el resultado*/
            const placeTooltip = (array, text) => {
              let newText = text;
              array.forEach((word) => {
                newText = newText.replace(
                  new RegExp(`\\b${word}\\b`),
                  `<div class="tooltip">${word}<span class="tooltiptext">tooltip</span></div>`
                );
              });
              return newText;
            };
            let contenido = $(".layout-content").html();
            contenido = placeTooltip(matchingWords, contenido);
            $(".layout-content").html(contenido);
          },
          error: function (xhr, status, error) {
            console.log("Error en la solicitud AJAX:", error);
          },
        });
      });
    },
  };
})(jQuery, Drupal);
