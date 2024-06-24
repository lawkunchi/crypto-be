import React from "react";
import { Head, usePage, useForm } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import TextInput from "@/Components/TextInput";
import InputLabel from "@/Components/InputLabel";
import InputError from "@/Components/InputError";
import PrimaryButton from "@/Components/PrimaryButton";
export default function AddCourse({ auth }) {
    const { props } = usePage();
    const { flash } = props;

    const { data, setData, post, processing, errors } = useForm({
        name: "",
        image: null,
    });

    const submit = (e) => {
        e.preventDefault();
        post(route("course.store"), {
            transform: (data) => {
                const formData = new FormData();
                Object.keys(data).forEach((key) =>
                    formData.append(key, data[key])
                );
                return formData;
            },
            onSuccess: () => setData({ name: "", image: null }),
        });
    };

    const onFileChange = (e) => {
        setData("image", e.target.files[0]);
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Add Course
                </h2>
            }
        >
            <form
                onSubmit={submit}
                className="p-12 bg-white border-b border-gray-100"
            >
                {flash?.message && (
                    <div className="alert alert-success">{flash?.message}</div>
                )}

                <div>
                    <InputLabel htmlFor="name" value="Course Name" />
                    <TextInput
                        id="name"
                        type="text"
                        name="name"
                        value={data.name}
                        className="mt-1 block w-full"
                        autoComplete="name"
                        isFocused={true}
                        onChange={(e) => setData("name", e.target.value)}
                    />
                    <InputError message={errors.name} className="mt-2" />
                </div>
                <div>
                    <InputLabel htmlFor="image" value="Course Image" />
                    <input
                        type="file"
                        id="image"
                        name="image"
                        className="mt-1 mb-5 block w-full file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0
                        file:text-sm file:font-semibold
                        file:bg-violet-50 file:text-violet-700
                        hover:file:bg-violet-100"
                        onChange={onFileChange}
                    />
                    <InputError message={errors.image} className="mt-2" />
                </div>
                <PrimaryButton type="submit" disabled={processing}>
                    Create Course
                </PrimaryButton>
            </form>
        </AuthenticatedLayout>
    );
}
