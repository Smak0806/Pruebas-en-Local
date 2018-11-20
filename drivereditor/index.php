<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0">
        <script type="text/javascript" src="javascript/codemirror.js"></script>
        <script type="text/javascript" src="javascript/css.js"></script>
        <script type="text/javascript" src="javascript/jquery-3.3.1.min.js"></script>
        <script type="text/javascript" src="javascript/jquery.form.js"></script>
        <script type="text/javascript" src="javascript/jsScript.js"></script>
        <link href="css/codemirror.css" rel="stylesheet"/>
        <link href="css/style.css" rel="stylesheet"/>
        <link href="css/icomoon.css" rel="stylesheet"/>
        <link href="divTable/divTableClass.css" rel="stylesheet"/>
        <title>Compact TOUCH driver editor</title>
    </head>
    <body>
        <div id="divToolbar">
            <div id ="divToolbarLeft">
                <button class="btnTransparent btnMenu" id="btnTextMode"><span class="icon-file-text"></span></button>
                <button class="btnTransparent btnMenu" id="btnDictionaryMode"><span class="icon-book"></span></button>
                <button class="btnTransparent btnMenu" id="btnTableMode"><span class="icon-table2"></span></button>
            </div>
            <div id="divToolbarRight">
                <div><button class="btnTransparent btnSectionDep" id="btnSort"><span class="icon-sort-numeric-asc"></span></button></div>
                <div><button class="btnTransparent btnRefresh btnSectionDep" id="btnRefreshText"><span class="icon-loop2"></span></button></div>
               <!-- <div><button class="btnTransparent btnRefresh" id="btnRefreshDictionary"><span class="icon-loop2"></span></button></div>-->
                <div><button class="btnTransparent btnRefresh btnSectionDep" id="btnRefreshTable"><span class="icon-loop2"></span></button></div>
                <div><a class="btnTransparent" href="manual.pdf" target="_blank"><span class="icon-question"></span></a></div>
            </div>
        </div>
        <div id="divContenedor">
            <div class="divEditor" id="divTextMode">
                <div id="fileUploadsText" class="lowerBar">
                    <form action="javascript:void(0);" class="myAjaxForm" method="post" enctype="multipart/form-data" target="_self" id="frmUploadDriver" name="submitFile">
                        <label for="driverFile" style="font-size: large;text-align: left;"><strong>DRIVER</strong></label>
                        <input type="file" name="driverFile" id="driverFile">                        
                        <button type="submit" class="btnTransparent"><span class="icon-upload2"></span></button>
                    </form>
                </div>
                <textarea name="filecontent" id="txtEditor">Paste the driver file here</textarea>
                <script>
                    editor = CodeMirror.fromTextArea(document.getElementById("txtEditor"), 
                    {
                        lineNumbers: true,
                        mode:  "css",
                    });
                </script>
                <div class="lowerBar">
                    <form action="toFile.php" method="post" target="_blank" id="frmDownloadDriver">
                            <input type="hidden" id="hidFilenameDriver" name="filename" value="">
                            <input type="hidden" id="hidFileContentDriver" name="filecontent" value="">
                            Download the driver file&nbsp;<button type="submit" class="btnTransparent" onclick="$('#hidFileContentDriver').val(editor.getValue())"><span class="icon-download2"></span></button>
                    </form>
                </div>
            </div>
            <div class="divEditor" id="divDictionaryMode">
                <div class="divDict">
                    <div id="fileUploadsDictionaryGen" class="lowerBar">
                        <form action="javascript:void(0);" class="myAjaxForm" method="post" enctype="multipart/form-data" target="_self" id="frmUploadDictionaryGen" name="submitFile">
                            <label for="dictionaryGenFile" style="font-size: large;text-align: left;"><strong>GENERIC DICTIONARY</strong></label>
                            <input type="file" name="dictionaryFile" id="dictionaryGenFile">
                            <button type="submit" class="btnTransparent"><span class="icon-upload2"></span></button>
                        </form>
                    </div>
                    <div>
                        <textarea name="filecontent2" id="txtDictionaryGen">Paste the generic dictionary here</textarea>
                        <script>
                            dictionary = CodeMirror.fromTextArea(document.getElementById("txtDictionaryGen"), 
                            {
                                lineNumbers: true,
                                mode:  "css",
                            });
                        </script>
                    </div>
                    <div class="lowerBar">
                        <form action="toFile.php" method="post" target="_blank" id="frmDownloadDriver">
                                <input type="hidden" id="hidFilenameDictionaryGen" name="filename" value="">
                                <input type="hidden" id="hidFileContentDictionaryGen" name="filecontent" value="">
                                Download the generic dictionary file&nbsp;<button type="submit" class="btnTransparent" onclick="$('#hidFileContentDictionaryGen').val(dictionary.getValue())"><span class="icon-download2"></span></button>
                        </form>
                    </div>
                </div>
                <div class="divDict">
                    <div id="fileUploadsDictionary" class="lowerBar">
                        <form action="javascript:void(0);" class="myAjaxForm" method="post" enctype="multipart/form-data" target="_self" id="frmUploadDictionary" name="submitFile">
                            <label for="dictionaryFile" style="font-size: large;text-align: left;"><strong>DEVICE DICTIONARY</strong></label>
                            <input type="file" name="dictionaryFile" id="dictionaryFile">
                            <button type="submit" class="btnTransparent"><span class="icon-upload2"></span></button>
                        </form>
                    </div>
                    <div>
                        <textarea name="filecontent3" id="txtDictionary">Paste the specific dictionary here</textarea>
                        <script>
                            dictionary2 = CodeMirror.fromTextArea(document.getElementById("txtDictionary"), 
                            {
                                lineNumbers: true,
                                mode:  "css",
                            });
                        </script>
                    </div>
                    <div class="lowerBar">
                        <form action="toFile.php" method="post" target="_blank" id="frmDownloadDriver">
                                <input type="hidden" id="hidFilenameDictionary" name="filename" value="">
                                <input type="hidden" id="hidFileContentDictionary" name="filecontent" value="">
                                Download the device dictionary file&nbsp;<button type="submit" class="btnTransparent" onclick="$('#hidFileContentDictionary').val(dictionary2.getValue())"><span class="icon-download2"></span></button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="divEditor" id="divTableMode"></div>
        </div>
    </body>
</html>
