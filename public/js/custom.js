    // Switch function for different switch buttons
    function switch_function(event,ens_group_hash,pers_group_hash,ens_input_id,pers_input_id) {
        var isChecked = event.target.getAttribute("value");
        if (isChecked === "false") {
        event.target.setAttribute("value","true");
        $(pers_group_hash).removeClass("d-none");
        $(ens_group_hash).addClass("d-none");
        document.getElementById(ens_input_id).value = "";
        
        }
        else {
        event.target.setAttribute("value","false")
        $(pers_group_hash).addClass("d-none");
        $(ens_group_hash).removeClass("d-none");
        document.getElementById(pers_input_id).value = "";
        }
    };
    
    // Page on click interactivity
    $(document).ready(function(){

        // Fixing nav pills behavior to switch between cases
        $('.nav-link.border').click(function(event){
        var curId = event.target.getAttribute("data-bs-target");
        $(".tab-pane").removeClass("show active");
        $(".accordion-collapse").removeClass("show");
        $(".nav-link").removeClass("active");
        $(".tab-pane" + curId).addClass("show active"); 
        event.target.classList.add("active");
        $("#homeButton").addClass("active");
        });
        
        // Activating switches between Ensembl and personal files
        $('#gtfswitch1').click(function(event){
            switch_function(event,
                            ens_group_hash="#ensgtf1input",
                            pers_group_hash="#gtf1input",
                            ens_input_id="ens_gtf1",
                            pers_input_id="gtf1")
            });
        
        $('#chrswitch1').click(function(event){
            switch_function(event,
                            ens_group_hash="#enschr1input",
                            pers_group_hash="#chr1input",
                            ens_input_id="ens_chr1",
                            pers_input_id="chr1")
            });
        
        $('#gtfswitch2').click(function(event){
            switch_function(event,
                            ens_group_hash="#ensgtf2input",
                            pers_group_hash="#gtf2input",
                            ens_input_id="ens_gtf2",
                            pers_input_id="gtf2")
            });

        $('#chrswitch2').click(function(event){
            switch_function(event,
                            ens_group_hash="#enschr2input",
                            pers_group_hash="#chr2input",
                            ens_input_id="ens_chr2",
                            pers_input_id="chr2")
            });

        $('#chrswitch3').click(function(event){
            switch_function(event,
                            ens_group_hash="#enschr3input",
                            pers_group_hash="#chr3input",
                            ens_input_id="ens_chr3",
                            pers_input_id="chr3")
            });

        $('#chrswitch4').click(function(event){
            switch_function(event,
                            ens_group_hash="#enschr4input",
                            pers_group_hash="#chr4input",
                            ens_input_id="ens_chr4",
                            pers_input_id="chr4")
            });
    
        // Demo button tour with intro.js
        $('#demoButton').click(function(event){
            $(".tab-pane").removeClass("show active");
            $(".accordion-collapse").removeClass("show");
            $(".nav-link").removeClass("active");
            $(".tab-pane" + "#case1").addClass("show active");
            $(".nav-link" + "#nav-BED-GTF-tab").addClass("active");
            introJs().setOptions({
            steps: [{
                title: 'Welcome',
                intro: "Hello there! 👋<br> Welcome to Web-OLOGRAM's website.<br> We will take you on a quick introductory tour.<br> Click next to continue."
            },
            {
                title: 'Analysis cases',
                element: document.querySelector('#nav-tab'),
                intro: "First, you can click here to choose your analysis case."
            },
            {
                title: 'Required input fields',
                element: document.querySelector('#case1-required'),
                intro: "Then, right below you will find the required input fields you need to fill."
            },
            {
                title: 'Information',
                element: document.querySelector('#bed1-info'),
                intro: "If any field is unclear to you you can click on these icons for a popup information guide.",
                position: 'bottom'
            },
            {
                title: 'Advanced options',
                element: document.querySelector('#heading1-advanced'),
                onbeforechange: function(){
                document.querySelector('#heading1-advanced').click();
                },
                intro: "Next you choose the advanced options you want to add to your request."
            },
            {
                title: 'Submit button',
                element: document.querySelector('#case1-submit'),
                intro: "Finally, you can click here to submit your request."
            },
            {
                title: 'Issue report',
                element: document.querySelector('#reportButton'),
                intro: "If you encounter any bugs or errors please let us know by quickly filling the issue report.<br> Your feedback is very much appreciated to improve the app &#128522; <br>",
                position: 'bottom'
            }],
            "skipLabel": "Skip",
            showProgress: true,
            disableInteraction: true,
            }).start();
            });
        
    });