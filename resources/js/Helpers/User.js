import Token from './Token';
import AppStorage from './AppStorage';
class User {
    login(data){
        axios.post('/api/auth/login', data)
              .then(res => this.processAfterLoggedIn(res.data))
              .catch(err => console.log(err.response.data))
    }

    processAfterLoggedIn(data){
        const access_token = data.access_token;
        const userName = data.user;
        if(Token.isvalid(access_token)){
            AppStorage.storeInLocal(access_token, userName);
        }else{
            console.log('INVALID TOKEN');
        }
    }

    hasToken(){
        const storedToken = AppStorage.getToken();
        if(storedToken){
            return Token.isvalid(storedToken);
        }
        return false;
    }

    loggedIn(){
        return this.hasToken();
    }

    logout(){
        AppStorage.ramoveFromLocal();
    }
}

export default User = new User();