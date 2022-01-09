import {HttpClient} from "@angular/common/http";
import {Injectable} from "@angular/core";
import {environment} from "../../../environments/environment";

@Injectable({
  providedIn: 'root'
})
export class ImageService {
  constructor(private http: HttpClient) {
  }

  createUrl(image_id: number, spec: string): string {
    if (image_id) {
      return environment.apiUrl + '/images/' + image_id + '/thumb/' + spec;
    }
    return '';
  }
}
