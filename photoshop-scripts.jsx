function main(){  

    if(!documents.length) return;  
    var Name = app.activeDocument.name.replace(/\.[^\.]+$/, '');   
    var saveFile = File(activeDocument.path +"/" + Name + ".new.jpg");  
    if(saveFile.exists){  
       if(!confirm("Overwrite existing document?" + saveFile)) return;  
        saveFile.remove();  
        }  
    SaveForWeb(saveFile,66); //change to 60 for 60%  
}  

main();  

function SaveForWeb(saveFile,jpegQuality) {  
    var sfwOptions = new ExportOptionsSaveForWeb();   
       sfwOptions.format = SaveDocumentType.JPEG;   
       sfwOptions.includeProfile = false;   
       sfwOptions.interlaced = 0;   
       sfwOptions.optimized = true;   
       sfwOptions.quality = jpegQuality; //0-100   
    activeDocument.exportDocument(saveFile, ExportType.SAVEFORWEB, sfwOptions);
} 