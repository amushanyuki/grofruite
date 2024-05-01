import React, { useState } from 'react';

function AddProducts() {
  const [formData, setFormData] = useState({
    name: '',
    description: '',
    price: '',
    // Add other form fields as needed
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevFormData) => ({
      ...prevFormData,
      [name]: value,
    }));
  };

  const handleSubmit = (e) => {
    e.preventDefault();
    // Send form data to API for adding the product
    // Implement API call here
  };

  return (
    <div>
      <h2>Add Products</h2>
      <form onSubmit={handleSubmit}>
        <input type="text" name="name" value={formData.name} onChange={handleChange} placeholder="Product Name" required />
        <textarea name="description" value={formData.description} onChange={handleChange} placeholder="Product Description" required />
        <input type="number" name="price" value={formData.price} onChange={handleChange} placeholder="Product Price" required />
        {/* Add other form fields as needed */}
        <button type="submit">Add Product</button>
      </form>
    </div>
  );
}

export default AddProducts;
