
function A0(){

    return {
        "welcomeMessage":"Welcome",
        "welcomeSet":function(message){
            this.welcomeMessage = message;
            return this;
        },
        "welcomeShow":function(){
            console.log(this.welcomeMessage);
            return this;
        }
    };
};

A0().welcomeSet("Welcome To A0 Framefork").welcomeShow();
