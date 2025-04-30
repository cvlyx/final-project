import type { FromSchema } from 'json-schema-to-ts';
import * as schemas from './schemas';
export type InitiateTransactionBodyParam = FromSchema<typeof schemas.InitiateTransaction.body>;
export type InitiateTransactionResponse200 = FromSchema<typeof schemas.InitiateTransaction.response['200']>;
export type InitiateTransactionResponse400 = FromSchema<typeof schemas.InitiateTransaction.response['400']>;
export type VerifyTransactionStatusMetadataParam = FromSchema<typeof schemas.VerifyTransactionStatus.metadata>;
export type VerifyTransactionStatusResponse200 = FromSchema<typeof schemas.VerifyTransactionStatus.response['200']>;
export type VerifyTransactionStatusResponse400 = FromSchema<typeof schemas.VerifyTransactionStatus.response['400']>;
