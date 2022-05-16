import {Injectable} from "@angular/core";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {environment} from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})

export class AuthService {
  baseUrl: string = environment.apiUrl + '/oauth'

  constructor(private http: HttpClient) {
  }

  login(username: string, password: string): Observable<any> {
    return this.http.post<any>(`${this.baseUrl}/token`, {
      grant_type: environment.ouath2.grantType,
      username: username,
      password: password,
      client_id: environment.ouath2.clientId,
      client_secret: environment.ouath2.clientSecret,
    });
  }
}
