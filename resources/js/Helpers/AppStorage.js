class AppStorage {
    /**Store token in local storage */
    setToken(token){
        localStorage.setItem('token', token);
    }

    /**Store username in local storage */
    setUser(user){
        localStorage.setItem('user', user);
    }

    /**
     * Call setToken and Username function to store data in
     * local Storage
     */
    storeInLocal(token, user){
        this.setToken(token);
        this.setUser(user);
    }

    /**Return token from local Storage */
    getToken(){
        return localStorage.getItem('token');
    }

    /**Return username from local storage */
    getUser(){
        return localStorage.getItem('user');
    }

    /**Remove token and username from local storage */
    ramoveFromLocal(){
        localStorage.removeItem('token');
        localStorage.removeItem('user');
    }
}

export default AppStorage = new AppStorage();