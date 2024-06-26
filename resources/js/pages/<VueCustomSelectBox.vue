<VueCustomSelectBox
                                            :options="product.sizes"
                                            v-model="selectedSize"
                                            label="name"
                                            track-by="id"
                                            class="custom-select"
                                        />
                                            <p>
                                            Selected Size:
                                            {{ selectedSize.name }}
                                        </p>
                                        <p>
                                            Price: ${{
                                                calculatedPrice.toFixed(2)
                                            }}
                                        </p>
                                            <VueCustomSelectBox
                                                v-model="result"
                                                :options="options"
                                                option-value="id"
                                                option-text="title"
                                            />
                                            <VueCustomSelectBox
                                            v-model="selectedSize"
                                            :options="product.sizes"
                                            option-value="id"
                                            option-text="name"
                                        />

                                        <select
                                                class="wide"
                                                v-model="selectedSize"
                                            >
                                                <option
                                                    v-for="size in product.sizes"
                                                    :key="size"
                                                    :value="size"
                                                >
                                                    {{ size.name }}
                                                </option>
                                            </select>

                                             <!-- <div class="numbers-row">
                                            <input
                                                type="number"
                                                v-model.number="quantity"
                                                class="qty2"
                                                name="quantity"
                                                min="1"
                                            />
                                        </div> -->



                                        <div class="custom-select-form"> 
                                            <select class="wide" style="display: none;"  v-model="selectedSize">
                                                <option
                                                    v-for="size in product.sizes"
                                                    :key="size"
                                                    :value="size"
                                                >
                                                    {{ size.name }}
                                                </option>
                                                
                                            </select>
                                            <div class="nice-select wide" tabindex="0">
                                            <span class="current">Small</span>
                                            <ul class="list">
                                                <li data-value="" class="option selected">Small</li>
                                                <li data-value="" class="option">Medium</li>
                                                <li data-value="" class="option">Large</li>
                                                <li data-value="" class="option">Extra Large</li><
                                                li data-value="" class="option">Extra Extra Large</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <select
                                                class="wide"
                                                v-model="selectedSize"
                                                @change="updatePrice"
                                            >
                                                <option
                                                    v-for="size in product.sizes"
                                                    :key="size.id"
                                                    :value="size"
                                                >
                                                    {{ size.name }} + ({{
                                                        size.increases
                                                    }}đ)
                                                </option>
                                            </select>