var stringed="";
function execute()
    {
        my_form = document.createElement("form");
        my_form.setAttribute('method',"post");
        my_form.setAttribute('action',"process.php");
        document.body.appendChild(my_form);
        var NumFiles = document.getElementById("textbox").value;
        var NumFilesString = String(NumFiles);
        var hidden = document.createElement("Input");
        hidden.type = "hidden";
        hidden.name = "hid";
        hidden.value = NumFilesString;
        my_form.appendChild(hidden);
        var hidden1 = document.createElement("Input");
        hidden1.type = "hidden";
        hidden1.name = "c_id";
        hidden1.value = String(document.getElementById("course_id").value);
        my_form.appendChild(hidden1);
        var i=1;
        while(NumFiles>0)
        {
            var input = document.createElement("Input");
            input.type = "text";
            input.name = i;
            input.id = i;
            //var exp = document.body;
            my_form.appendChild(input);
            var br = document.createElement("br");
            my_form.appendChild(br);
            var br1 = document.createElement("br");
            my_form.appendChild(br1);
            NumFiles = NumFiles-1;
            i=i+1;
        }
        /*var button = document.createElement("button");
        button.id = "submit";
        button.type = "submit";
        button.name = "submit";
        button.onclick = "submit()";
        button.innerHTML = "Submit";
        var exp = document.body;
        exp.appendChild(button);*/
        var sub_button = document.createElement("INPUT");
        sub_button.setAttribute('type',"submit");                       //button for submission original
        sub_button.setAttribute('name',"submit");
        sub_button.setAttribute('value',"Submit");
        my_form.appendChild(sub_button);
        /*var sub_button = document.createElement("BUTTON");
        sub_button.setAttribute('id',"files");                      
        sub_button.setAttribute('onclick',"return process()");
        my_form.appendChild(sub_button);
        sub_button.innerHTML = "Next";*/
    }

/*function process()
{
    form = document.createElement("form");
    form.setAttribute('method',"post");
    form.setAttribute('action',"insert.php");
    document.body.appendChild(form);
    var NumFiles = document.getElementById("textbox").value;
    var NumFilesString = String(NumFiles);
    var i=1;
    while(NumFiles>0)
    {
            var subtype = document.getElementById(String(i)).value;
            var subtypestring = String(subtype);
            var lastindex = subtypestring.lastIndexOf(" ");
            lastindex = lastindex+1;
            //document.write(String(lastindex));
            var nf = subtypestring.substring(lastindex);
            var nfint = parseInt(nf);
            while(nfint>0)
                {
                    var input = document.createElement("Input");
                    input.type = "text";
                    input.name = subtypestring.substring(0,lastindex);
                    form.appendChild(input);
                    var br = document.createElement("br");
                    form.appendChild(br);
                    var br1 = document.createElement("br");
                    form.appendChild(br1);
                    nfint = nfint-1;
                }
        NumFiles = NumFiles-1;
        i=i+1;
    }
    var sub_button = document.createElement("INPUT");
    sub_button.setAttribute('type',"submit");                       //button for submission original
    sub_button.setAttribute('name',"submit");
    sub_button.setAttribute('value',"Submit");
    form.appendChild(sub_button);
}*/