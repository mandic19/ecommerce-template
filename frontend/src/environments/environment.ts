// This file can be replaced during build by using the `fileReplacements` array.
// `ng build --prod` replaces `environment.ts` with `environment.prod.ts`.
// The list of file replacements can be found in `angular.json`.

export const environment = {
  production: false,
  appName: "Pizzeria Luigi",
  apiUrl: 'http://api.ecommerce_template.local/v1',
  minOrderTotal: 4,
  businessDays: [0, 1, 2, 3, 4, 5, 6],
  businessHours: {
    from: 8,
    to: 22
  },
  defaultLang: 'en',
  lang: 'sr'
};

/*
 * For easier debugging in development mode, you can import the following file
 * to ignore zone related error stack frames such as `zone.run`, `zoneDelegate.invokeTask`.
 *
 * This import should be commented out in production mode because it will have a negative impact
 * on performance if an error is thrown.
 */
// import 'zone.js/dist/zone-error';  // Included with Angular CLI.
