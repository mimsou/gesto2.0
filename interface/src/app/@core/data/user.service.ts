import {Injectable} from '@angular/core';
import {HttpClient} from '@angular/common/http';
import {ApiLink} from './api.link'

@Injectable({
    providedIn: 'root'
})
export class UserService {

    constructor(private http: HttpClient, private apiLink: ApiLink) {
    }

    allUser() {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/user`);
    }

    searchUser(term: string) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/user/${term}`);
    }


    addUser(user) {
        var param = {};
        param.fullName = user.UserName;
        param.email = user.UserEmail;
        param.confirmPassword = user.UserPasworld;
        return this.http.post(`${this.apiLink.MANAGER_BASE_URL}/user/`, JSON.stringify(param));
    }

    deleteUser(id) {
        return this.http.delete(`${this.apiLink.MANAGER_BASE_URL}/user/${id}`);
    }

    linkedUser($role){
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/linkeduser/${$role}`);
    }

    updateUser(term: string) {
        return this.http.get(`${this.apiLink.MANAGER_BASE_URL}/user/${term}`);
    }

}
