import {Component, OnChanges, OnDestroy, OnInit} from '@angular/core';
import {CartService} from "./services/cart.service";
import {ICartItem} from "./item/cart-item";
import {Subscription} from "rxjs";
import {environment} from "../../environments/environment";
import {ICart} from "./cart";
import {FormBuilder} from "@angular/forms";
import {IOrder} from "../order/order";

@Component({
  selector: 'ecm-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit, OnDestroy {
  cartSub!: Subscription;

  minOrderTotal: number = environment.minOrderTotal;
  checkoutActive: boolean = false;
  items: ICartItem[];
  total: number;

  constructor(private cartService: CartService, private fb: FormBuilder) {
    this.cartSub = this.cartService.getUpdate().subscribe(cart => this.setCart(cart));
  }

  ngOnInit(): void {
    this.setCart(this.cartService.getCart());
  }

  ngOnDestroy(): void {
    this.cartSub?.unsubscribe();
  }

  toggleCheckout(): void {
    this.checkoutActive = !this.checkoutActive;
  }

  setCart(cart: ICart): void {
    this.items = cart.items;
    this.total = cart.total;
    this.checkoutActive = false;
  }

  removeFromCart(cartItem: ICartItem): void {
    this.cartService.removeFromCart(cartItem);
  }

  onOrderCompleted(): void {
    this.cartService.setCart([]);
    this.checkoutActive = true;
  }
}
