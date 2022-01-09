import {Component, Input} from "@angular/core";
import {ImageService} from "../../shared/image/image.service";
import {IProduct} from "../product";

@Component({
  selector: 'app-product-card',
  templateUrl: './product-card.component.html',
  styleUrls: ['./product-card.component.css']
})
export class ProductCardComponent {
  @Input() product: IProduct;

  constructor(private imageService: ImageService) {
  }

  getImageUrl(image_id: number): string {
    return this.imageService.createUrl(image_id, 'w250_h300_fs1');
  }
}
