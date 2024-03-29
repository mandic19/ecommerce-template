import {Component, EventEmitter, Input, OnInit, Output} from '@angular/core';
import {ImageService} from '../../shared/image/image.service';
import {IProduct} from '../product';
import {CartService} from "../../cart/services/cart.service";
import {ICartItem} from "../../cart/item/cart-item";
import {IProductVariant} from "../product-variant/product-variant";

@Component({
  selector: 'ecm-product-card',
  templateUrl: './product-card.component.html',
  styleUrls: ['./product-card.component.css']
})
export class ProductCardComponent implements OnInit {
  @Input() product: IProduct;
  @Output() productThumbClicked: EventEmitter<any> = new EventEmitter<object>();
  private selectedProductVariant: IProductVariant;

  constructor(private imageService: ImageService, private cartService: CartService) {
  }

  ngOnInit(): void {
    this.selectedProductVariant = this.product.variants[0];
  }

  selectVariant(productVariantId: string): void {
    this.selectedProductVariant = this.product.variants.find(x => x.id == parseInt(productVariantId));
  }

  addToCart(): void {
    let name: string = this.product.name;

    if(this.selectedProductVariant) {
      name += ' - (' + this.selectedProductVariant.name + ')';
    }

    let item: ICartItem = {
      product_id: this.product.id,
      name: name,
      product_variant_id: this.selectedProductVariant?.id,
      sku: this.selectedProductVariant?.sku || this.product.sku,
      quantity: 1,
      price: this.selectedProductVariant?.price || this.product.price
    };

    this.cartService.addToCart(item);
  }

  getImageUrl(imageId: number): string {
    return this.imageService.createUrl(imageId, 'w120_h120_fs1');
  }

  onProductThumbClick(): void {
    const imageIds: number[] = [this.product.cover_image_id, ...this.product.additional_image_ids].filter(n => n);

    if(imageIds.length > 0) {
      this.productThumbClicked.emit(imageIds);
    }
  }
}
