$('document').ready(function ()
{
    function normalizeTable()
    {
        var nRows = $('#nRows').val();
        
        for (var r = 0; r < nRows; r++)
        {
            var maxVal = 0;
            var nCols = $('#nCols').val();
            for (var c = 0; c < nCols; c++)
            {
                if ($('#divCell_' + r + '_' + c).outerHeight() > maxVal)
                {
                    maxVal = $('#divCell_' + r + '_' + c).outerHeight();
                }
                $('.divCell_' + r).css('min-height', maxVal + 'px');
                $('.divCell_' + r).css('vertical-align', 'top');
            }
        }
    }

    function getValues()
    {
        var nRows = $('#nRows').val();
        var v = [];
        
        for (var r = 0; r < nRows; r++)
        {
            if (!$('#ln_' + r).length)
            {
                continue;
            }
            
            var nCols = $('#nCols_' + r).val();
            var type = 1;
            
            if($('#cmt_' + r).prop('checked'))
            {
                type = 3;
            }
            
            var myRow = {'type' : type};
            
            for (var c = 0; c < nCols; c++)
            {
                if ($('#ln_' + r + '_' + c).length)
                {
                    myRow[c] = $('#ln_' + r + '_' + c).val();
                }
                else
                {
                    myRow[c] = /*(type == 3) ? 'RESERVED' :*/ '';
                }
            }
            
            v[r] = myRow;
        }
        
        return v;
    }
    
    function getDriverValue()
    {
        var v = getValues();
        
        var dataToSend = {'json' : JSON.stringify(v)};
        var result = '';
        $.ajax({
                type: 'POST',
                url: "ajaxToDriver.php",
                timeout: 30000,
                dataType: 'text',
                data: dataToSend,
                async: false
            }).done(function(data)
            {
                result = data;
            });
            
        return result;
    }
    
    function buttonNeedsUpdate(id)
    {
        $(id).css('color', '#ff9393');
    }
    
    function buttonUpdated(id)
    {
        $(id).css('color', '#888888');
    }
    
    function buttonActive(id)
    {
        $('.btnMenu').css('color','#888888');
        $(id).css('color','#ed7304');
    }
    
    buttonActive('#btnTextMode');
    
    function tableNeedsUpdate()
    {
        buttonNeedsUpdate('#btnRefreshTable');
    }
    
    $('.myAjaxForm').ajaxForm();
    
    $('body').on('change', '.commentCheckBox', function()
    {
        var id = $(this).attr('id');
        console.log(id);
        var bgcolor = ($(this).prop('checked')) ? '#C8C8C8' : '#FFFFFF';
        var aux = id.split('_');        
        var nCols = $('#nCols_' + aux[1]).val();
        
        for (var i = 0; i < nCols; i++)
        {
            $('#ln_' + aux[1] + '_' + i).css('background-color', bgcolor);
        }
    });
    
    $('#btnSort').on('click', function ()
    {
        $('#btnSort').addClass('loadingBtn');
        var v = getValues();
        var dataToSend = {
            'json' : JSON.stringify(v),
            'dictionaryGen': dictionary.getValue(), 
            'dictionarySpec': dictionary2.getValue()
        };
        
        $.ajax({
                type: 'POST',
                url: "ajaxSortDriver.php",
                timeout: 30000,
                dataType: 'text',
                data: dataToSend,
                async: false
            }).done(function(data)
            {
                $('#divTableMode').html(data);
                buttonNeedsUpdate('#btnRefreshText');
            });  
        $('#btnSort').removeClass('loadingBtn');
    });
    
    $('#btnTextMode').on('click', function()
    {
        if ($('#divTextMode').css('display') == 'none')
        {
            buttonActive('#btnTextMode');
            $('.divEditor').css('display','none');
            $('#divTextMode').css('display','block');
            $('.btnSectionDep').css('display','none');
            $('#btnRefreshText').css('display','block');
            editor.refresh();
        }
    });
    
    $('#btnDictionaryMode').on('click', function()
    {
        if ($('#divDictionaryMode').css('display') == 'none')
        {
            buttonActive('#btnDictionaryMode');
            $('.divEditor').css('display','none');
            $('#divDictionaryMode').css('display','flex');
            $('.btnSectionDep').css('display','none');
            /*$('#btnRefreshText').css('display','block');*/
            dictionary.refresh();
            dictionary2.refresh();
        }
    });
    
    $('#btnTableMode').on('click', function()
    {
        if ($('#divTableMode').css('display') == 'none')
        {           
            buttonActive('#btnTableMode');
            $('.divEditor').css('display','none');
            $('#divTableMode').css('display','block');
            $('.btnSectionDep').css('display','none');
            $('#btnRefreshTable').css('display','block');
            $('#btnSort').css('display','block');
        }
    });
    
    $('#btnRefreshText').on('click', function()
    {
        $('#btnRefreshText').addClass('loadingBtn');
        var driver = getDriverValue();
        editor.setValue(driver);
        editor.refresh();
        buttonUpdated('#btnRefreshText');
        $('#btnRefreshText').removeClass('loadingBtn');
    });
    
    $('#btnRefreshTable').on('click', function()
    {
        $('#btnRefreshTable').addClass('loadingBtn');
        var dataToSend = {
            'driver':editor.getValue(), 
            'dictionaryGen': dictionary.getValue(), 
            'dictionarySpec': dictionary2.getValue()
        };
        
        $.ajax({
                type: 'POST',
                url: "ajaxParseDriver.php",
                timeout: 30000,
                dataType: 'text',
                data: dataToSend,
                async: false
            }).done(function(data)
            {
                $('#divTableMode').html(data);
                //setTimeout(normalizeTable, 0);
            });
            
        buttonUpdated('#btnRefreshTable');
        $('#btnRefreshTable').removeClass('loadingBtn');
    });
    
    $('body').on('change', '.tableElement', function()
    {
        buttonNeedsUpdate('#btnRefreshText');
    });
    
    editor.on('change', function()
    {
        tableNeedsUpdate();
    });
    
    dictionary.on('change', function()
    {
        tableNeedsUpdate();
    });
    
    dictionary2.on('change', function()
    {
        tableNeedsUpdate();
    });
    
    $('#frmUploadDriver').submit(function()
    {
        $(this).ajaxSubmit({
            url:'ajaxUploadFile.php', 
            success: function(data)
            {
                editor.setValue(data);
                editor.refresh();
                
                var fileInput = document.getElementById('driverFile');
                $('#hidFilenameDriver').val(fileInput.files[0].name);
            }
        });
        
        return false;
    });
    
    $('#frmUploadDictionary').submit(function()
    {
        $(this).ajaxSubmit({
            url:'ajaxUploadFile.php', 
            success: function(data)
            {
                dictionary2.setValue(data);
                dictionary2.refresh();
                
                var fileInput = document.getElementById('dictionaryFile');
                $('#hidFilenameDictionary').val(fileInput.files[0].name);
            }
        });
        
        return false;
    });
    
    $('#frmUploadDictionaryGen').submit(function()
    {
        $(this).ajaxSubmit({
            url:'ajaxUploadFile.php', 
            success: function(data)
            {
                dictionary.setValue(data);
                dictionary.refresh();
                
                var fileInput = document.getElementById('dictionaryGenFile');
                $('#hidFilenameDictionaryGen').val(fileInput.files[0].name);
            }
        });
        
        return false;
    });
    
    $('body').on('click', '.btnDel', function()
    {
        var id = $(this).attr('id');
        var aux = id.split('_');
        var row = aux[1];
        $("[id='ln_" + row + "']").remove();
        buttonNeedsUpdate('#btnRefreshText');
    });
    
    $('body').on('click', '#btnAdd', function()
    {
        $("[id='addRow']").remove();
        var n = $('#nRows').val();
        $('#nRows').val(parseInt(n) + 1);
        var newRow = '<tr id="ln_' + n + '">\n\
                        <input id="nCols_' + n + '" value="25" type="hidden">\n\
                        <td>\n\
                            <button class="btnTransparentSmall btnDel" id="btnDel_' + n + '">\n\
                                <span class="icon-cross"></span>\n\
                            </button>\n\
                            <input id="cmt_' + n + '" class="commentCheckBox tableElement" type="checkbox">#\n\
                        </td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_0" size="16" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_1" size="11" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_2" size="9" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_3" size="8" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_4" size="10" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_5" size="8" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_6" size="6" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_7" size="13" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_8" size="15" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_9" size="10" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_10" size="10" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_11" size="11" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_14" size="10" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_15" size="12" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_20" size="10" type="text"></td>\n\
                        <td><input class="tableElement" id="ln_' + n + '_21" size="10" type="text"></td>\n\
                        <td><textarea class="tableElement" id="ln_' + n + '_22" cols="50" rows="1">Y </textarea></td>\n\
                        <td><input class="tableElement" style="background-color:#C8C8C8;" id="ln_' + n + '_23" value="#" size="50" type="text"></td>\n\
                    </tr>';
        $("[id='tDriver']").append(newRow);
        $("[id='tDriver']").append('<tr id="addRow"><td colspan="2"><br><button class="btnTransparent" id="btnAdd"><span class="icon-plus"></span></button><br></td></tr>');
    });
});