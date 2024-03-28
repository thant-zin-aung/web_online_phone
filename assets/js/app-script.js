// fetch api usage...
// fetch(serverUrl+'../../balance.php').then((response) => response.json())
// .then((data) => console.log(data.balance));
var serverUrl = window.location.hostname+window.location.pathname;
var twilioPhoneVerifyPage = "https://console.twilio.com/us1/develop/phone-numbers/manage/verified";
var hideSectionClassname = "hide-section";
var addShadowBoxClassname = "add-shadow-box";
let selectedReceiverNumberClassName = "selected-receiver-number";
let popUpOnClassName = "pop-up-on";
let popUpOffClassName = "pop-up-off";
var popUpTimeout = 5;
var balanceErrorMessage = "n/a";
var serverOfflineMessage = "Offline";
var serverOnlineMessage = "Online";
let totalReceivers = 0;
let totalCallers = 0;
let finalReceiverName = "";
let finalReceiverPhone = "";
let finalCallerName = "";
let finalCallerPhone = "";

let navBarWrapper = document.querySelector(".nav-bar-wrapper");
let successPopUpBoxWrapper = document.querySelector(".success-pop-up-box-wrapper");
let failPopUpBoxWrapper = document.querySelector(".fail-pop-up-box-wrapper");
let successPopUpBoxText = document.querySelector(".success-pop-up-box-wrapper .text");
let failPopUpBoxText = document.querySelector(".fail-pop-up-box-wrapper .text");

let smsPlaygroundArea = document.querySelector(".play-ground-wrapper .sms-play-ground-area");
let voiceMessagePlaygroundArea = document.querySelector(".play-ground-wrapper .voice-message-play-ground-area");
let makeACallPlaygroundArea = document.querySelector(".play-ground-wrapper .make-a-call-play-ground-area");
let playgroundArea = document.querySelector("#play-ground-area");
let chooseSmsButton = document.querySelector(".choice-section-wrapper .sms-section");
let chooseVoiceMessageButton = document.querySelector(".choice-section-wrapper .voice-message-section");
let chooseMakeAPhoneCallButton = document.querySelector(".choice-section-wrapper .phone-call-section");

let availableReceiverWrapper = document.querySelector("#available-receiver .available-receiver-list-wrapper");
let selectedReceiverNumber = document.querySelector(".selected-receiver-number");

let serverStatusBulb = document.querySelector(".server-status-wrapper .down-part .server-status-bulb");
let serverStatus = document.querySelector(".server-status-wrapper .down-part .server-status-text");
let balanceText = document.querySelector(".balance-text");

let addUserButton = document.querySelector("#available-receiver .title-wrapper .add-user");

let receiverInfoName = document.querySelector(".sms-receiver-info-wrapper .name span");
let receiverInfoPhone = document.querySelector(".sms-receiver-info-wrapper .phone span");

let messageBox = document.querySelector(".play-ground-wrapper .sms-play-ground-area .message-box");
let sendSmsButton = document.querySelector(".play-ground-wrapper .sms-play-ground-area .send-sms-button");

let audioTag = document.querySelector(".audio-tag");
let voiceMessageFile = document.querySelector("#voiceMessageFile");
let voiceMessagePathText = document.querySelector(".voice-message-file-path");
let sendVoiceMessageButton = document.querySelector(".voice-message-play-ground-area .send-voice-message-button");
let voiceMessagePath;
let selectedVoiceMessageFile;

let callerNumberSection = document.querySelector("#caller-number");
let availableCallerWrapper = document.querySelector("#caller-number .caller-number-wrapper .available-number-wrappers");
let callerNumberCloseButton = document.querySelector("#caller-number .close-button");
let startCallButton = document.querySelector("#caller-number .caller-number-wrapper .call-button-wrapper");


// Initializing stage...
balanceText.innerHTML = balanceErrorMessage;
serverStatusBulb.style.color = "orange";
serverStatus.innerHTML = "Obtaining";
serverStatus.style.color = "orange";

window.addEventListener('scroll',(e)=>{
    if(window.pageYOffset>0){
        navBarWrapper.classList.add(addShadowBoxClassname);
    }else{
        navBarWrapper.classList.remove(addShadowBoxClassname);
    }
});

let setPlaygroundAreaHidden = (setHide , ...playgrounds) => {
    playgrounds.forEach( playground => {
        if ( setHide === true ) {
            playground.classList.add(hideSectionClassname);
        } else {
            if ( playground.classList.remove(hideSectionClassname));
        }
    });
};

let hideAllPlaygroundArea = () => {
    setPlaygroundAreaHidden(true,smsPlaygroundArea,voiceMessagePlaygroundArea,makeACallPlaygroundArea);
};

setPlaygroundAreaHidden(true,voiceMessagePlaygroundArea,makeACallPlaygroundArea);

chooseSmsButton.addEventListener("click",() => {
    hideAllPlaygroundArea();
    setPlaygroundAreaHidden(false,smsPlaygroundArea);
    window.scrollTo(0, document.body.scrollHeight);
});
chooseVoiceMessageButton.addEventListener("click",() => {
    hideAllPlaygroundArea();
    setPlaygroundAreaHidden(false,voiceMessagePlaygroundArea);
    window.scrollTo(0, document.body.scrollHeight);
});
chooseMakeAPhoneCallButton.addEventListener("click",() => {
    hideAllPlaygroundArea();
    setPlaygroundAreaHidden(false,makeACallPlaygroundArea);
    window.scrollTo(0, document.body.scrollHeight);
});

let playPopUpBox = (isSuccessBox,notifyMessage) => {
    if (isSuccessBox===true) {
        successPopUpBoxText.innerHTML = notifyMessage;
        successPopUpBoxWrapper.classList.add(popUpOnClassName);
        setTimeout(() => {
            successPopUpBoxWrapper.classList.remove(popUpOnClassName);
        }, popUpTimeout*1000);
    } else {
        failPopUpBoxText.innerHTML = notifyMessage;
        failPopUpBoxWrapper.classList.add(popUpOnClassName);
        setTimeout(() => {
            failPopUpBoxWrapper.classList.remove(popUpOnClassName);
        }, popUpTimeout*1000);
    }
};
callerNumberCloseButton.addEventListener("click",()=>{
    callerNumberSection.style.display = "none";
});

let gotoTwilioPhoneVerifyPage = ()=> { window.location = twilioPhoneVerifyPage; }

addUserButton.addEventListener("click",()=>{
    gotoTwilioPhoneVerifyPage();
});


// Fetching balance from twilio server...
let fetchBalance = () => {
    // fetch api usage...
    fetch(serverUrl+'../../balance.php').then((response) => response.text())
    .then((data) => {
        // If the server is able to be connect...
        // showing server status and set balance to html element...
        if ( data !== "error" ) {
            balanceText.innerHTML = "$ "+data;
            serverStatusBulb.setAttribute("style","color: #28B463");
            serverStatus.innerHTML = serverOnlineMessage;
            serverStatus.setAttribute("style","color: #28B463");
        } else {
            serverStatusBulb.style.color = "red";
            serverStatus.innerHTML = serverOfflineMessage;
            serverStatus.style.color = "red";
        }
    });
}

let removeAllHighlightReceivers = () => {
    let availableReceiverSubWrapper = document.querySelectorAll("#available-receiver .available-receiver-list-wrapper .available-number-wrapper");
    for ( var sid=0 ; sid < availableReceiverSubWrapper.length ; sid++ ) {
        availableReceiverSubWrapper[sid].classList.remove(selectedReceiverNumberClassName);
    }
}
let removeAllHighlightCallers= () => {
    let availableCallerSubWrapper = document.querySelectorAll("#caller-number .caller-number-wrapper .available-number-wrappers .available-number-wrapper");
    for ( var sid=0 ; sid < availableCallerSubWrapper.length ; sid++ ) {
        availableCallerSubWrapper[sid].classList.remove(selectedReceiverNumberClassName);
    }
}

let fetchAvailableReceivers = () => {
    fetch(serverUrl+'../../available-receivers.php').then((response) => response.json())
    .then((data) => {
        totalReceivers = data.length;
        for ( let id = 0 ; id < totalReceivers ; id++ ) {
            var receiverName = data[id][0];
            var receiverPhoneNumber = data[id][1].replace("+95","0");
            availableReceiverWrapper.innerHTML += `
                <div class="available-number-wrapper" id="receiver-id-${id}">
                    <div class="name">${receiverName}</div>
                    <div class="phone">${receiverPhoneNumber}</div>
                </div>
            `;
        }
        for ( let id = 0 ; id < totalReceivers ; id++ ) {
            document.querySelector("#receiver-id-"+id).addEventListener("click",()=>{
                var receiverName = data[id][0];
                var receiverPhoneNumber = data[id][1];
                finalReceiverName = receiverName;
                finalReceiverPhone = receiverPhoneNumber;
                if ( !document.querySelector("#receiver-id-"+id).classList.contains(selectedReceiverNumberClassName) ) {
                    // remove selected classname from all element...
                    removeAllHighlightReceivers();
                    document.querySelector("#receiver-id-"+id).classList.add(selectedReceiverNumberClassName);
                    receiverInfoName.innerHTML = finalReceiverName;
                    receiverInfoPhone.innerHTML = finalReceiverPhone.replace("+95","0");
                } else {
                    document.querySelector("#receiver-id-"+id).classList.remove(selectedReceiverNumberClassName);
                    receiverInfoName.innerHTML = "Unknown";
                    receiverInfoPhone.innerHTML = "N/A";
                    finalReceiverName = "";
                    finalReceiverPhone = "";
                }
            });
        }
    });
}

let fetchAvailableCallers = () => {
    fetch(serverUrl+'../../available-receivers.php').then((response) => response.json())
    .then((data) => {
        totalCallers = data.length;
        for ( let id = 0 ; id < totalCallers ; id++ ) {
            var callerName = data[id][0];
            var callerPhoneNumber = data[id][1].replace("+95","0");
            availableCallerWrapper.innerHTML += `
                <div class="available-number-wrapper" id="caller-id-${id}">
                    <div class="name">${callerName}</div>
                    <div class="phone">${callerPhoneNumber}</div>
                </div>
            `;
        }
        for ( let id = 0 ; id < totalCallers ; id++ ) {
            document.querySelector("#caller-id-"+id).addEventListener("click",()=>{
                var callerName = data[id][0];
                var callerPhoneNumber = data[id][1];
                finalCallerName = callerName;
                finalCallerPhone = callerPhoneNumber;
                if ( !document.querySelector("#caller-id-"+id).classList.contains(selectedReceiverNumberClassName) ) {
                    // remove selected classname from all element...
                    removeAllHighlightCallers();
                    document.querySelector("#caller-id-"+id).classList.add(selectedReceiverNumberClassName);
                } else {
                    document.querySelector("#caller-id-"+id).classList.remove(selectedReceiverNumberClassName);
                    finalCallerName = "";
                    finalCallerPhone = "";
                }
            });
        }
    });
}

fetchBalance();
fetchAvailableReceivers();
fetchAvailableCallers();

// Manipulating SMS
let sendSMS = () => {
        $.ajax({
        url: serverUrl+'../../send-sms.php',
        type: 'POST',
        data: {smsMessage:messageBox.value,receiverPhone:finalReceiverPhone},
        success: function(data) {
            console.log(data);
            if ( data === "queued" ) {
                playPopUpBox(true,"Message was sent successfully.");    
            } else {
                playPopUpBox(false,"Failed to send message.");
            }
            clearAllStage();
        }
    });
}
sendSmsButton.addEventListener("click",()=> {
    if ( messageBox.value.trim().length === 0) {
        alert("Message box cannot be empty.");
    } else if ( finalReceiverPhone.length === 0  ) {
        alert("Please select a receiver phone number.");
    } else {
        sendSMS();
    }
});

// Manipulating Voice Message and upload file...
voiceMessageFile.addEventListener("change",e => {
    selectedVoiceMessageFile = e.target.files[0];
    voiceMessagePath = URL.createObjectURL(e.target.files[0]);
    audioTag.src = voiceMessagePath;
    voiceMessagePathText.innerHTML = selectedVoiceMessageFile.name;
});
let sendVoiceMessage = (voiceMessageUrl) => {
        $.ajax({
        url: serverUrl+'../../voice_message.php',
        type: 'POST',
        data: {receiver_number:finalReceiverPhone,voiceMessageUrl:voiceMessageUrl},
        success: function(data) {
            console.log(data); // Inspect this in your console
            playPopUpBox(true,"Voice message was sent successfully.");
        }
    });
}
let uploadAndSendVoiceMessageFile = function() {
    var form_data = new FormData();                  
    form_data.append('voiceMessageFile', selectedVoiceMessageFile);                       
    $.ajax({
        url: serverUrl+'../../file_upload.php', // <-- point to server-side PHP script 
        dataType: 'text',  // <-- what to expect back from the PHP script, if anything
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,                         
        type: 'post',
        success: function(response_data){
            if ( response_data === "upload_failed" ) {
                playPopUpBox(false,"Failed to upload voice message file.");
            } else {
                sendVoiceMessage(response_data);
                clearAllStage();
            }
            
        }
     });
}
sendVoiceMessageButton.addEventListener("click",()=> {
    if (!selectedVoiceMessageFile) {
        alert("Please upload a voice message file.");
    } else if ( finalReceiverPhone.length === 0 ) {
        alert("Please select a receiver phone number.");
    } else {
        uploadAndSendVoiceMessageFile();
    }
});


// Manipulating phone calls
makeACallPlaygroundArea.addEventListener("click",()=>{
    if ( finalReceiverPhone.length === 0 ) {
        alert("Please select a receiver number");
    } else {
        callerNumberSection.style.display="block";
    }
});

startCallButton.addEventListener("click",()=>{
    if ( finalCallerPhone.length === 0 ) {
        alert("Please select a caller number");
    } else if ( finalCallerPhone === finalReceiverPhone ) {
        alert("Caller and receiver numbers cannot be the same.");
    } else {
        callerNumberSection.style.display="none";


        // do some success things...
        $.ajax({
            url: serverUrl+'../../phone-conference-call.php',
            type: 'POST',
            data: {
                callerName:finalCallerName,
                callerPhoneNumber:finalCallerPhone,
                receiverName:finalReceiverName,
                receiverPhone:finalReceiverPhone
            },
            success: function(data) {
                console.log(data);
                if ( data === "success" ) {
                    playPopUpBox(true,"Calls instantiated successfully.");
                } else {
                    playPopUpBox(false,"Failed to instantiate calls.");
                }
            }
        });

        clearAllStage();
    }
});





// Clearing all stage back to normal...
let clearAllStage = () => {
    finalReceiverName = "";
    finalReceiverPhone = "";
    finalCallerName = "";
    finalCallerPhone = "";
    messageBox.value = "";
    removeAllHighlightReceivers();
    receiverInfoName.innerHTML = "Unknown";
    receiverInfoPhone.innerHTML = "N/A";
};