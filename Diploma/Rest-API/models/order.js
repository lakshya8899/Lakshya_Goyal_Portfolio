const mongoose = require('mongoose');

const orderSchema = new mongoose.Schema({
  OrderNo: { type: Number, required: true, unique: true },
  OrderDate: { type: String, required: true },
  CustNo: { type: Number, required: true },
  ProductCode: { type: Number, required: true },
  ProductName: { type: String, required: true },
  ProductQuantity: { type: Number, required: true },
  ProductPrice: { type: Number, required: true },
  Total: { type: Number, required: true },
  ModeOfPayment: { type: String, required: true }
});
module.exports = mongoose.model('Order', orderSchema);

