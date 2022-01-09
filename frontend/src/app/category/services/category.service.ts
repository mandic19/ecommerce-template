import {Injectable} from "@angular/core";
import {environment} from "../../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {ICategory} from "../category";

@Injectable({
  providedIn: 'root'
})

export class CategoryService {
  baseUrl: string = environment.apiUrl + '/categories'

  constructor(private http: HttpClient) {
  }

  getCategories(params: any = {}): Observable<ICategory[]> {
    return this.http.get<ICategory[]>(this.baseUrl, {params: params});
  }
}
