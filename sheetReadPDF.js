const fs = require('fs')
const { PdfReader } = require('pdfreader')
fs.readFile('Tabela Jandira.pdf', (err, pdfBuffer) =>{
  new PdfReader().parseBuffer(pdfBuffer, (err, item) => {
    if(err) console.error("error: ",err);
    else if(!item) console.warn("end of buffer");
    else if(item.text) console.log(item.text);
  });
});
