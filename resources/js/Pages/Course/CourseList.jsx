import React from "react";
import { Link, usePage } from "@inertiajs/react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";

export default function CoursesList({ courses, auth }) {
    const { flash } = usePage().props;
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Add Course
                </h2>
            }
        >
            <div className="my-4">
                <Link
                    href={route("course.add")}
                    className="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 "
                >
                    Add Course
                </Link>

                {flash.message && (
                    <div
                        class="p-4 mb-4 mt-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                        role="alert"
                    >
                        <span class="font-medium">{flash.message}</span>
                    </div>
                )}
            </div>
            <div className="overflow-x-auto relative shadow-md sm:rounded-lg">
                <table className="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                    <thead className="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" className="py-3 px-6">
                                Course Name
                            </th>
                            <th scope="col" className="py-3 px-6">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {courses.map((course) => (
                            <tr
                                key={course.id}
                                className="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600"
                            >
                                <td className="py-4 px-6">
                                    <img
                                        src={course.image}
                                        alt="Course Thumbnail"
                                        className="w-10 h-10 mr-4 rounded-full"
                                    />
                                    {course.name}
                                </td>
                                <td className="py-4 px-6">
                                    <Link
                                        href={route("course.view", course.id)}
                                        className="font-medium text-green-600 dark:text-green-500 hover:underline"
                                    >
                                        View
                                    </Link>
                                    <Link
                                        href={route("course.edit", course.id)}
                                        className="font-medium text-blue-600 dark:text-blue-500 hover:underline ml-4"
                                    >
                                        Edit
                                    </Link>
                                    <Link
                                        href={route("course.delete", course.id)}
                                        method="delete"
                                        as="button"
                                        className="font-medium text-red-600 dark:text-red-500 hover:underline ml-4"
                                    >
                                        Delete
                                    </Link>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </AuthenticatedLayout>
    );
}
