import {Component, OnDestroy, OnInit} from '@angular/core';
import {CartService} from "./services/cart.service";
import {ICartItem} from "./item/cart-item";
import {Subscription} from "rxjs";
import {environment} from "../../environments/environment";
import {ICart} from "./cart";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {formattedError} from "@angular/compiler";

@Component({
  selector: 'ecm-cart',
  templateUrl: './cart.component.html',
  styleUrls: ['./cart.component.css']
})
export class CartComponent implements OnInit, OnDestroy {
  private cartSub: Subscription;
  minOrderTotal: number = environment.minOrderTotal;
  checkoutActive: boolean = false;
  items: ICartItem[];
  total: number;

  checkoutForm: FormGroup;

  constructor(private cartService: CartService, private fb: FormBuilder) {
    this.cartSub = this.cartService.getUpdate().subscribe(cart => this.setCart(cart));
  }

  ngOnInit(): void {
    this.setCart(this.cartService.getCart());
    this.checkoutForm = this.fb.group({
      name: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      address: ['', Validators.required],
      phone: ['', Validators.required],
      notes: ''
    });
  }

  ngOnDestroy(): void {
    this.cartSub.unsubscribe();
  }

  setCart(cart: ICart): void {
    this.items = cart.items;
    this.total = cart.total;
    this.checkoutActive = false;
  }

  toggleCheckout(): void {
    this.checkoutActive = !this.checkoutActive;
  }

  removeFromCart(cartItem: ICartItem): void {
    this.cartService.removeFromCart(cartItem);
  }

  submit(): void {
    console.log(this.checkoutForm.getRawValue());
  }

  isInvalidField(fieldName: string): boolean {
    let formControl = this.checkoutForm.get(fieldName);
    return (formControl.touched || formControl.dirty) && !formControl.valid;
  }
}
