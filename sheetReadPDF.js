const filename = 'Tabela Jandira.pdf';
var PdfReader = require('pdfreader');

const nbCols = 1;

const padColumns = (array, nb) =>
  Array.apply(null,{length: nb}).map((val, i) => array[i] || []);

const mergeCells = (cells) => (cells || [])
  .map((cell) => cell.text).join('_');

const renderMatrix = (matrix) => (matrix || [])
  .map((row, y) => padColumns(row, nbCols)
    .map(mergeCells)
    .join("|")
  ).join('\n');

var table = new PdfReader.TableParser();

new PdfReader.PdfReader().parseFileItems(filename, (err, item) => {
  if(!item || item.page) {
   console.log(renderMatrix(table.getMatrix()));
   table = new PdfReader.TableParser(); 
  }
  else if(item.text){
    table.processItem(item, item);
  }
});
