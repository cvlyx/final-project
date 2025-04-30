declare const InitiateTransaction: {
    readonly body: {
        readonly type: "object";
        readonly required: readonly ["amount", "currency", "callback_url", "return_url"];
        readonly properties: {
            readonly amount: {
                readonly type: "string";
                readonly description: "Amount to charge the customer.";
            };
            readonly currency: {
                readonly type: "string";
                readonly description: "Currency to charge in. [ 'MWK', 'USD' ]";
                readonly default: "MWK";
            };
            readonly tx_ref: {
                readonly type: "string";
                readonly description: "Your transaction reference. This MUST be unique for every transaction.";
            };
            readonly first_name: {
                readonly type: "string";
                readonly description: "This is the first_name of your customer.";
            };
            readonly last_name: {
                readonly type: "string";
                readonly description: "This is the last_name of your customer. (optional)";
            };
            readonly callback_url: {
                readonly type: "string";
                readonly description: "This is your IPN url, it is important for receiving payment notification. Successful transactions redirects to this url after payment. {tx_ref} is returned, so you don't need to pass it with your url";
            };
            readonly return_url: {
                readonly type: "string";
                readonly description: "Once the customer cancels or after multiple failed attempts, we will redirect to the return_url with the query parameters tx_ref and status of failed. (optional)";
            };
            readonly email: {
                readonly type: "string";
                readonly description: "This is the email address of your customer. Transaction notification will be sent to this email address (optional)";
            };
            readonly meta: {
                readonly type: "string";
                readonly description: "You can pass extra information here. (optional)";
            };
            readonly uuid: {
                readonly type: "string";
                readonly description: "(optional)";
            };
            readonly customization: {
                readonly properties: {
                    readonly title: {
                        readonly type: "string";
                        readonly description: "(optional)";
                    };
                    readonly description: {
                        readonly type: "string";
                        readonly description: "(optional)";
                    };
                };
                readonly required: readonly [];
                readonly type: "object";
            };
        };
        readonly $schema: "https://json-schema.org/draft/2020-12/schema#";
    };
    readonly response: {
        readonly "200": {
            readonly type: "object";
            readonly properties: {
                readonly message: {
                    readonly type: "string";
                    readonly examples: readonly ["Hosted payment session generated successfully."];
                };
                readonly status: {
                    readonly type: "string";
                    readonly examples: readonly ["success"];
                };
                readonly data: {
                    readonly type: "object";
                    readonly properties: {
                        readonly event: {
                            readonly type: "string";
                            readonly examples: readonly ["checkout.session:created"];
                        };
                        readonly checkout_url: {
                            readonly type: "string";
                            readonly examples: readonly ["https://test-checkout.paychangu.com/7887951180"];
                        };
                        readonly data: {
                            readonly type: "object";
                            readonly properties: {
                                readonly tx_ref: {
                                    readonly type: "string";
                                    readonly examples: readonly ["98993331-d4f4-4840-899f-7b46cacbb9f4"];
                                };
                                readonly currency: {
                                    readonly type: "string";
                                    readonly examples: readonly ["MWK"];
                                };
                                readonly amount: {
                                    readonly type: "integer";
                                    readonly default: 0;
                                    readonly examples: readonly [1000];
                                };
                                readonly mode: {
                                    readonly type: "string";
                                    readonly examples: readonly ["sandbox"];
                                };
                                readonly status: {
                                    readonly type: "string";
                                    readonly examples: readonly ["pending"];
                                };
                            };
                        };
                    };
                };
            };
            readonly $schema: "https://json-schema.org/draft/2020-12/schema#";
        };
        readonly "400": {
            readonly type: "object";
            readonly properties: {
                readonly status: {
                    readonly type: "string";
                    readonly examples: readonly ["failed"];
                };
                readonly message: {
                    readonly type: "string";
                    readonly examples: readonly ["currency is required"];
                };
                readonly data: {
                    readonly type: "string";
                    readonly examples: readonly ["null"];
                };
            };
            readonly $schema: "https://json-schema.org/draft/2020-12/schema#";
        };
    };
};
declare const VerifyTransactionStatus: {
    readonly metadata: {
        readonly allOf: readonly [{
            readonly type: "object";
            readonly properties: {
                readonly tx_ref: {
                    readonly type: "integer";
                    readonly format: "int32";
                    readonly default: 2345;
                    readonly minimum: -2147483648;
                    readonly maximum: 2147483647;
                    readonly $schema: "https://json-schema.org/draft/2020-12/schema#";
                    readonly description: "Obtain the transaction ID from the tx_ref present in the response you receive after creating a transaction";
                };
            };
            readonly required: readonly ["tx_ref"];
        }];
    };
    readonly response: {
        readonly "200": {
            readonly type: "object";
            readonly properties: {
                readonly status: {
                    readonly type: "string";
                    readonly examples: readonly ["success"];
                };
                readonly message: {
                    readonly type: "string";
                    readonly examples: readonly ["Payment details retrieved successfully."];
                };
                readonly data: {
                    readonly type: "object";
                    readonly properties: {
                        readonly event_type: {
                            readonly type: "string";
                            readonly examples: readonly ["checkout.payment"];
                        };
                        readonly tx_ref: {
                            readonly type: "string";
                            readonly examples: readonly ["PA54231315"];
                        };
                        readonly mode: {
                            readonly type: "string";
                            readonly examples: readonly ["live"];
                        };
                        readonly type: {
                            readonly type: "string";
                            readonly examples: readonly ["API Payment (Checkout)"];
                        };
                        readonly status: {
                            readonly type: "string";
                            readonly examples: readonly ["success"];
                        };
                        readonly number_of_attempts: {
                            readonly type: "integer";
                            readonly default: 0;
                            readonly examples: readonly [1];
                        };
                        readonly reference: {
                            readonly type: "string";
                            readonly examples: readonly ["26262633201"];
                        };
                        readonly currency: {
                            readonly type: "string";
                            readonly examples: readonly ["MWK"];
                        };
                        readonly amount: {
                            readonly type: "integer";
                            readonly default: 0;
                            readonly examples: readonly [1000];
                        };
                        readonly charges: {
                            readonly type: "integer";
                            readonly default: 0;
                            readonly examples: readonly [40];
                        };
                        readonly customization: {
                            readonly type: "object";
                            readonly properties: {
                                readonly title: {
                                    readonly type: "string";
                                    readonly examples: readonly ["iPhone 10"];
                                };
                                readonly description: {
                                    readonly type: "string";
                                    readonly examples: readonly ["Online order"];
                                };
                                readonly logo: {};
                            };
                        };
                        readonly meta: {};
                        readonly authorization: {
                            readonly type: "object";
                            readonly properties: {
                                readonly channel: {
                                    readonly type: "string";
                                    readonly examples: readonly ["Card"];
                                };
                                readonly card_number: {
                                    readonly type: "string";
                                    readonly examples: readonly ["230377******0408"];
                                };
                                readonly expiry: {
                                    readonly type: "string";
                                    readonly examples: readonly ["2035-12"];
                                };
                                readonly brand: {
                                    readonly type: "string";
                                    readonly examples: readonly ["MASTERCARD"];
                                };
                                readonly provider: {};
                                readonly mobile_number: {};
                                readonly completed_at: {
                                    readonly type: "string";
                                    readonly examples: readonly ["2024-08-08T23:21:22.000000Z"];
                                };
                            };
                        };
                        readonly customer: {
                            readonly type: "object";
                            readonly properties: {
                                readonly email: {
                                    readonly type: "string";
                                    readonly examples: readonly ["yourmail@example.com"];
                                };
                                readonly first_name: {
                                    readonly type: "string";
                                    readonly examples: readonly ["Mac"];
                                };
                                readonly last_name: {
                                    readonly type: "string";
                                    readonly examples: readonly ["Phiri"];
                                };
                            };
                        };
                        readonly logs: {
                            readonly type: "array";
                            readonly items: {
                                readonly type: "object";
                                readonly properties: {
                                    readonly type: {
                                        readonly type: "string";
                                        readonly examples: readonly ["log"];
                                    };
                                    readonly message: {
                                        readonly type: "string";
                                        readonly examples: readonly ["Attempted to pay with card"];
                                    };
                                    readonly created_at: {
                                        readonly type: "string";
                                        readonly examples: readonly ["2024-08-08T23:20:59.000000Z"];
                                    };
                                };
                            };
                        };
                        readonly created_at: {
                            readonly type: "string";
                            readonly examples: readonly ["2024-08-08T23:20:21.000000Z"];
                        };
                        readonly updated_at: {
                            readonly type: "string";
                            readonly examples: readonly ["2024-08-08T23:20:21.000000Z"];
                        };
                    };
                };
            };
            readonly $schema: "https://json-schema.org/draft/2020-12/schema#";
        };
        readonly "400": {
            readonly type: "object";
            readonly properties: {};
            readonly $schema: "https://json-schema.org/draft/2020-12/schema#";
        };
    };
};
export { InitiateTransaction, VerifyTransactionStatus };
