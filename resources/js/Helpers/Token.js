class Token{

    isvalid(token){
        const payload = this.payload(token);
        if(payload){
            console.log(payload);
            return payload.iss == "http://realtimeapp.test/api/auth/login" ? true : false;
        }
        return false;
    }

    payload(token){
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    decode(payload){
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();