import {Injectable} from '@angular/core';
import {ICartItem} from '../item/cart-item';
import {Observable, Subject} from "rxjs";
import {ICart} from "../cart";

@Injectable({
  providedIn: 'root'
})

export class CartService {
  private cartSubject = new Subject<any>();

  addToCart(cartItem: ICartItem): void {
    let addedToCart: boolean = false;
    let items: ICartItem[] = this.getCartItems().map(x => {
      if(x.product_id == cartItem.product_id && x.product_variant_id == cartItem.product_variant_id) {
        x.quantity += cartItem.quantity;
        addedToCart = true;
      }

      return x;
    })

    if(!addedToCart) {
      items.push(cartItem);
    }

    this.setCart(items);
  }

  removeFromCart(cartItem: ICartItem): void {
    let cartItems = this.getCartItems().filter(x => x.product_id != cartItem.product_id || x.product_variant_id != cartItem.product_variant_id);
    this.setCart(cartItems);
  }

  getCart(): ICart {
    return JSON.parse(localStorage.getItem('cart')) || {
      items: [],
      total: 0
    };
  }

  setCart(items: ICartItem[]): void {
    let total: number = 0;
    items.forEach(item => {
      total += item.quantity * item.price;
    });

    let cart: ICart = {
      items: items,
      total: total
    };

    localStorage.setItem('cart', JSON.stringify(cart));
    this.cartSubject.next(cart);
  }

  getCartItems(): ICartItem[] {
    return this.getCart().items || [];
  }

  getUpdate(): Observable<any> {
    return this.cartSubject.asObservable();
  }
}
