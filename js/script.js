function getStartedNav(id, id2) {
    document.getElementById(id).classList.remove('d-none');
    document.getElementById(id2).classList.add('d-none');

}




var activatedSiginContainer = 'studentSiginCotaier';
var activeBtn = 'studentbtn'
function SigninTabNav(id) {
    const newcontainer = document.getElementById(id + 'SiginCotaier');
    const oldcontainer = document.getElementById(activatedSiginContainer);

    anime({
        targets: '#' + activatedSiginContainer + '',
        translateX: 1000,
        autoplay: true,
        easing: 'easeInOutSine'

    });

    setTimeout(function () {
        oldcontainer.classList.add('d-none')
        newcontainer.classList.remove('d-none')

        anime({
            targets: '#' + activatedSiginContainer + '',
            translateX: 0,
            autoplay: true,
            easing: 'easeInOutSine'

        });
    }, 500);
    //alert(id+'btn')
    document.getElementById(activeBtn).classList.remove('active')
    document.getElementById(id + 'btn').classList.add('active')
    activeBtn = id + 'btn'
    activatedSiginContainer = id + 'SiginCotaier'



}

function showEror(header, body) {
    document.getElementById('toastErrorHeader').innerHTML = header
    document.getElementById('toastErrorBody').innerHTML = body


    const tost = document.getElementById('errorToast')
    var myToast = new bootstrap.Toast(tost);
    myToast.show();

}

function showSuccess(header, body) {
    document.getElementById('toastSuccessHeader').innerHTML = header
    document.getElementById('toastSuccessBody').innerHTML = body


    const tost = document.getElementById('successToast')
    var myToast = new bootstrap.Toast(tost);
    myToast.show();

}


// sigup part
function sigup() {
    const ids = ['sus_fname', 'sus_lname', 'sus_email', 'sus_password', 'sus_gender', 'sus_grade']
    const val = []
    const form = new FormData()
    for (var x = 0; ids.length > x; x++) {
        var data = document.getElementById(ids[x]).value
        form.append(ids[x], data)
        val.push(data);
    }

    const request = new XMLHttpRequest();
    request.open('POST', 'process/studentSigupProcess.php')
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            var response = request.responseText;
            alert(response)


            const responseObj = JSON.parse(response);

            if (responseObj['type'] == 'error') {

                // change all input border color as default border color
                for (var x = 0; ids.length > x; x++) {
                    const Comp = document.getElementById(ids[x])
                    Comp.style.borderColor = '#000000'
                }

                // change error input borde color as red
                const errorComp = document.getElementById(responseObj['trigger'])
                errorComp.style.borderColor = '#FF00FF'

                showEror("OOPS..!", responseObj[responseObj['trigger']])

            }

            if (responseObj['type'] == 'success') {

                showSuccess("Success!", "Successfully Created Your Account ! Now Signin to Continue!")
                SigninTabNav('student')

            } else {
                alert("Internal Error : ")
            }
        }
    }

    request.send(form)







}

// sigin 
function sigin(mode) {
    const email = document.getElementById(mode + "_email").value
    const password = document.getElementById(mode + "_password").value
    const rm = document.getElementById(mode + "_rm").checked

    const form = new FormData();
    form.append('email', email)
    form.append('password', password)
    form.append('rm', rm)
    form.append('mode', mode)




    const request = new XMLHttpRequest();
    request.open('POST', 'process/SiginProcess.php')
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            alert(response)
            const responseObj = JSON.parse(response)

            if (responseObj['mode'] == 'error') {
                showEror("OOPS..!", responseObj['trigger'])
            } else if (responseObj['mode'] == 'success') {
                if (mode == "ssi") {

                    if (responseObj['verify']) {

                        showSuccess("success!", "WellCome Studet!");

                        setTimeout(function () {
                            window.location = "studentPanel.php"

                        }, 1000)

                    } else {
                        showSuccess("success!", "Success! but need to be a verifyed Student to contiue!");
                        SigninTabNav('studentVerify')
                    }



                }
                else if (mode == "tsi") {
                    if (!responseObj['verification']) {
                        showSuccess("success!", "Success! but need to be a verifyed teacher to contiue!");
                        SigninTabNav('teacherVerify')

                    } else {

                        showSuccess("success!", "WellCome Studet!");

                        setTimeout(function () {
                            window.location = "studentPanel.php"

                        }, 1000)

                    }



                }
                else if (mode == "asi") {
                    if (!responseObj['verification']) {
                        showSuccess("success!", "Success! but need to be a verifyed acedemic officer to contiue!");
                        SigninTabNav('acadamicVerify')

                    } else {

                        showSuccess("success!", "WellCome Officer!");

                        setTimeout(function () {
                            window.location = "acedemic_panel.php"

                        }, 1000)

                    }

                }

            }

            // alert(response)
        }

    }

    request.send(form)



}

//verification code verify
function verify(mode) {
    const vc = document.getElementById(mode + "_vcode").value;

    const form = new FormData();
    form.append('vc', vc)
    form.append('mode', mode)


    const request = new XMLHttpRequest();

    request.open('POST', 'vcVerifie.php')
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            alert(response)

            const responseObj = JSON.parse(response);

            if (mode == "tsi") {
                if (responseObj['mode'] == 'success') {
                    window.location = 'teacherPanel.php';
                }

                else if (responseObj['mode'] == 'error') {
                    showEror("OOPS!", responseObj['trigger']);

                    const tsi_vcExprie = document.getElementById('tsi_vcExprie');
                    tsi_vcExprie.classList.remove('d-none')

                    if (typeof (responseObj['retypeTime']) != 'undefined') {
                        tsi_vcExprie.innerHTML = responseObj['retypeTime'] + " times left";
                    }

                    if (typeof (responseObj['retypeTimeMSG']) != 'undefined') {
                        tsi_vcExprie.innerHTML = responseObj['retypeTimeMSG'];


                    }

                }

            }

            if (mode == "asi") {
                if (responseObj['mode'] == 'success') {
                    window.location = 'acedemic_panel.php';
                }

                else if (responseObj['mode'] == 'error') {
                    showEror("OOPS!", responseObj['trigger']);

                    const tsi_vcExprie = document.getElementById('asi_vcExprie');
                    tsi_vcExprie.classList.remove('d-none')

                    if (typeof (responseObj['retypeTime']) != 'undefined') {
                        tsi_vcExprie.innerHTML = responseObj['retypeTime'] + " times left";
                    }

                    if (typeof (responseObj['retypeTimeMSG']) != 'undefined') {
                        tsi_vcExprie.innerHTML = responseObj['retypeTimeMSG'];


                    }

                }

            }
            if (mode == "ssi") {
                if (responseObj['mode'] == 'success') {
                    window.location = 'studentPanel.php';
                }

                else if (responseObj['mode'] == 'error') {
                    showEror("OOPS!", responseObj['trigger']);

                    const tsi_vcExprie = document.getElementById('ssi_vcExprie');
                    tsi_vcExprie.classList.remove('d-none')

                    if (typeof (responseObj['retypeTime']) != 'undefined') {
                        tsi_vcExprie.innerHTML = responseObj['retypeTime'] + " times left";
                    }

                    if (typeof (responseObj['retypeTimeMSG']) != 'undefined') {
                        tsi_vcExprie.innerHTML = responseObj['retypeTimeMSG'];


                    }

                }

            }


        }
    }
    request.send(form)
}


// get start select grade
function selectGrade_gs(id) {

    const form = new FormData();
    form.append('grade', id);

    const request = new XMLHttpRequest();
    request.open('POST', 'get_started_add_grade.php')
    request.onreadystatechange = function () {
        if (request.readyState == 4) {
            const response = request.responseText;
            const responseObj = JSON.parse(response);

            if (responseObj['type'] == 'success') {
                getStartedNav('getStart_P2', 'getStart_P1')
            }
            if (responseObj['type'] == 'error') {
                showEror('Error', responseObj['trigger'])

            }
        }
    }
    request.send(form)
}

// student agreement sigin
function agreemetSigin() {
    const form = new FormData();
    
    const request = new XMLHttpRequest();
    request.open('GET', 'agreemetSignin.php')

    request.onreadystatechange = function () {
        
        if (request.readyState == 4) {
            const response = request.responseText;
            const responseObj = JSON.parse(response);

            if (responseObj['type'] == 'erorr'){
                showEror(responseObj['trigger']);
            }else{
                window.location.reload()
            }
        }
    }

    request.send(form)

}

// student btn nav
var nowStudentPage = "s_home"
function s_btn_nav(page){
    const nowStudentPage_btn = document.getElementById("btn_"+nowStudentPage);
    nowStudentPage_btn.classList.remove('btn-dark');
    nowStudentPage_btn.classList.add('btn-outline-dark');

    const selectingStudentPage_btn = document.getElementById("btn_"+page);
    selectingStudentPage_btn.classList.add('btn-dark');
    selectingStudentPage_btn.classList.remove('btn-outline-dark');

    nowStudentPage = page
    const request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (request.readyState == 4){
            const response = request.responseText;

            document.getElementById('dashbordBody').innerHTML = response
            // alert(response)
        }

    }

    request.open('GET',page+'.php');
    request.send();





}

var nowAdminPage = "home";
function a_btn_nav(page){
    const nowStudentPage_btn = document.getElementById("btn_a_"+nowAdminPage);
    nowStudentPage_btn.classList.remove('btn-dark');
    nowStudentPage_btn.classList.add('btn-outline-dark');

    const selectingStudentPage_btn = document.getElementById("btn_a_"+page);
    selectingStudentPage_btn.classList.add('btn-dark');
    selectingStudentPage_btn.classList.remove('btn-outline-dark');

    nowAdminPage = page


    const request = new XMLHttpRequest();
    request.onreadystatechange = function(){
        if (request.readyState == 4){
            const response = request.responseText;

            document.getElementById('dashbordBody').innerHTML = response
            // alert(response)
        }

    }

    request.open('GET','a_'+page+'.php');
    request.send();
}

function Adminsigin(){
    const email = document.getElementById('asi_email').value;
    const password = document.getElementById('asi_password').value;

    const form = new FormData();
    form.append('email',email)
    form.append('password',password);
    
    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const response = request.responseText;
            const responseObj = JSON.parse(response);

            if (responseObj['type'] == 'error'){
                showEror('OOPS..!',responseObj['trigger'])

            }else if (responseObj['type'] == 'success'){
                showEror('success!',responseObj['trigger'])
                document.getElementById('AdminSiginCotaier').classList.add('d-none')
                document.getElementById('AdminVerifySiginCotaier').classList.remove('d-none')


            }
        }
    }
    request.open('POST','adminsigninProcess.php',true)
    request.send(form);


}

function AdminCodeverify(){
    const vc = document.getElementById('asi_vcode').value;
    const email = document.getElementById('asi_email').value;
    const password = document.getElementById('asi_password').value;

    const form = new FormData();
    form.append('email',email)
    form.append('password',password);
    form.append('vc',vc)
    
    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const response = request.responseText;
            const responseObj = JSON.parse(response);

            if (responseObj['type'] == 'error'){
                showEror('OOPS..!',responseObj['trigger'])

            }else if (responseObj['type'] == 'success'){
                showSuccess('success!',responseObj['trigger'])
                
                window.location = "adminPanel.php"


            }else{
                alert(response)
            }
        }
    }
    
    request.open('POST','adminVCProcess.php',true)
    request.send(form);
}

// grade on change event _ load subjects for grade
function GradeOptionChanged(grade_com_id,subject_com_id){
    const grade = document.getElementById(grade_com_id).value;
    
    const form = new FormData();
    form.append('grade',grade);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if (request.readyState == 4){
            const response = request.responseText;
            
            document.getElementById(subject_com_id).innerHTML = response
        }
    }
    request.open('POST','GetSubjectByGradePocess.php',true);
    request.send(form)
}
// Subject on change event _ load Grade for Subject
function SubjectOptionChanged(grade_com_id,subject_com_id){
    const subject = document.getElementById(subject_com_id).value;
    
    const form = new FormData();
    form.append('subject',subject);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if (request.readyState == 4){
            const response = request.responseText;
            
            document.getElementById(grade_com_id).innerHTML = response
        }
    }
    request.open('POST','GetGradeBySubjectPocess.php',true);
    request.send(form)

}

function inviteTeacher(){
    const email = document.getElementById('add_new_teacher_email').value;
    const fname = document.getElementById('add_new_teacher_fn').value;
    const lname = document.getElementById('add_new_teacher_ln').value;
    const grade = document.getElementById('add_new_teacher_gd').value;
    const subject = document.getElementById('add_new_teacher_sb').value;

    const form = new FormData();
    form.append('email',email);
    form.append('fname',fname);
    form.append('lname',lname);
    form.append('grade',grade);
    form.append('subject',subject);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const response = request.responseText;
            const responseObj = JSON.parse(response);

            if (responseObj['type'] == "erorr"){
                showEror("OOPS..!",responseObj['trigger'])

            }else if (responseObj['type'] == "success"){
                showSuccess("success","successfully added new teacher!")
            }else{
                alert(response)
            }
        }
    }
    request.open("POST","inviteTeacherProcess.php",true)
    request.send(form)





}

function inviteAcedemyc(){
    const email = document.getElementById('add_new_aco_email').value;
    const fname = document.getElementById('add_new_aco_fn').value;
    const lname = document.getElementById('add_new_aco_ln').value;
    const grade = document.getElementById('add_new_aco_gd').value;


    const form = new FormData();
    form.append('email',email);
    form.append('fname',fname);
    form.append('lname',lname);
    form.append('grade',grade);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const response = request.responseText;
            const responseObj = JSON.parse(response);

            if (responseObj['type'] == "erorr"){
                showEror("OOPS..!",responseObj['trigger'])

            }else if (responseObj['type'] == "success"){
                showSuccess("success","successfully added new Acedemyc Oficer !")
            }else{
                alert(response)
            }
        }
    }
    request.open("POST","inviteAcedemicOficerProcess.php",true)
    request.send(form)

}

function GetAllGrades(id){
    const request  = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const  respose = request.responseText;
            // document.getElementById(id).innerHTML = respose
        }
    }

    request.open("GET","GetAllGradesProcess.php",true);
    request.send()

}


function GetAllSubjects(id){
    const request  = new XMLHttpRequest();

    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const  respose = request.responseText;
            // document.getElementById(id).innerHTML = respose
        }
    }

    request.open("GET","GetAllSubjectProcess.php",true);
    request.send()

}

function GetAllSubjectAndGrades(SubjectCompId,gradeCompId){
    GetAllGrades(gradeCompId)
    GetAllSubjects(SubjectCompId)
}
function AddTeacherForSubjectAndGrade(id,email){
     const row = document.getElementById(id).value;
     
     if (row != "0"){
        const arr = row.split("@");
        const grade = arr[0];
        const subject =arr[1];

        const form = new FormData();
        form.append('grade',grade)
        form.append('subject',subject)
        form.append('email',email)

        const request = new XMLHttpRequest();
        request.onreadystatechange = function (){
            if(request.readyState == 4){
                const response = request.responseText;
                const responseObj = JSON.parse(response);

                if (responseObj['type'] == 'error'){
                    showEror("OOPS..!",responseObj['trigger'])
                }else if (responseObj['type'] == 'success'){
                    showEror("success!","successfully Added Subject and grade")

                    setTimeout(() => {
                        a_btn_nav('Teachers')
                    }, 2000);
                    
                }else{

                    alert(response)
                }
            }
        }
        request.open('POST',"AddGradeAndSubForTeacherProcess.php",true);
        request.send(form);
     }
}

function RemoveTeacherForSubjectAndGrade(id,email){
   
    const row = document.getElementById(id).value;
     
    if (row != "0"){
       const arr = row.split("@");
       const grade = arr[0];
       const subject =arr[1];

       const form = new FormData();
       form.append('grade',grade)
       form.append('subject',subject)
       form.append('email',email)

       const request = new XMLHttpRequest();
       request.onreadystatechange = function (){
           if(request.readyState == 4){
               const response = request.responseText;
               alert(response)
               const responseObj = JSON.parse(response);

               if (responseObj['type'] == 'error'){
                   showEror("OOPS..!",responseObj['trigger'])
               }else if (responseObj['type'] == 'success'){
                   showEror("success!","successfully Remove Subject and grade")

                   setTimeout(() => {
                       a_btn_nav('Teachers')
                   }, 2000);
                   
               }else{

                   alert(response)
               }
           }
       }
       request.open('POST',"RemoveGradeAndSubForTeacherProcess.php",true);
       request.send(form);
    }

}

function sendNotificationToTeacher(id,email){
    const text  = document.getElementById(id).value;
    const form = new FormData();
    form.append('email',email)
    form.append('msg',text);

    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if(request.readyState == 4){
            const response = request.responseText;
            alert(response);
        }
    }

    request.open('POST','SendNotificationToTeacher.php',true)
    request.send(form);

}

function AdminTeacherSearch(){
    const text = document.getElementById('a_teacher_search_txt').value;
    const grade=document.getElementById('a_teacher_search_gde').value;
    const sub=document.getElementById('a_teacher_search_sub').value;

    const form = new FormData()
    form.append('text',text)
    form.append('grade',grade)
    form.append('sub',sub)


    const request = new XMLHttpRequest();
    request.onreadystatechange = function (){
        if (request.readyState == 4){
            const response = request.responseText;
            document.getElementById('TeachersBody').innerHTML =response
        }
    }

    request.open("POST","AdminSearchTeacher.php",true);
    request.send(form);


}