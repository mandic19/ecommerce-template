import {Injectable} from "@angular/core";
import {environment} from "../../../environments/environment";
import {HttpClient} from "@angular/common/http";
import {Observable} from "rxjs";
import {IProduct} from "../product";

@Injectable({
  providedIn: 'root'
})

export class ProductService {
  baseUrl: string = environment.apiUrl + '/products'

  constructor(private http: HttpClient) {
  }

  getProducts(params: any = {}): Observable<IProduct[]> {
    return this.http.get<IProduct[]>(this.baseUrl, {params: params});
  }
}
