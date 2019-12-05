class Token{

    /**
     * Check if the payload is valid or not 
     * based on iss
     * @returns Bool
     * @param {Decoded payload} token 
     */
    isvalid(token){
        const payload = this.payload(token);
        if(payload){
            return payload.iss == "http://realtimeapp.test/api/auth/login" || "http://realtimeapp.test/api/auth/signup" ? true : false;
        }
        return false;
    }

    /**
     * The JWT token has 3part. "Header, Payload, Signature"
     * Split the token for decoding payload part.
     */
    payload(token){
        const payload = token.split('.')[1];
        return this.decode(payload);
    }

    /**Decode the payload for ISS=>"Issued Srever" */
    decode(payload){
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();